<?php

namespace Destiny;

use bandwidthThrottle\tokenBucket\Rate;
use bandwidthThrottle\tokenBucket\storage\PredisStorage;
use bandwidthThrottle\tokenBucket\TokenBucket;
use Barryvdh\Debugbar\Facade as Debugbar;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Cache;
use DestinyException;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\FileCookieJar;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Redis;
use function GuzzleHttp\Promise\settle;

/**
 * Class DestinyClient.
 */
class DestinyClient extends Client
{
    protected $domain = 'https://www.bungie.net';
    protected $baseUri = '/d1/platform/';

    protected $destinyPrivacyRestriction = 1665;
    protected $destinyLegacyPlatformErrorCode = 1670;

    protected $proxyUrl = null;

    /** @var TokenBucket $bucket */
    public static $bucket = null;

    /**
     * DestinyClient constructor.
     *
     * @param array $apiKey
     */
    public function __construct($apiKey)
    {
        $config = [
            'base_uri' => $this->domain.$this->baseUri,
            'cookies'  => new FileCookieJar(storage_path('cookies')),
            'headers'  => [
                'User-Agent' => 'DestinyStatus.com',
                'X-API-Key'  => $apiKey,
            ],
        ];

        parent::__construct($config);

        $this->proxyUrl = config('destiny.proxy_url', null);
    }

    /**
     * @param \Destiny\DestinyRequest[]|\Destiny\DestinyRequest $requests
     *
     * @throws \DestinyException
     * @throws \Exception
     *
     * @return array
     */
    public function r($requests)
    {
        $multi = true;

        if ($requests instanceof DestinyRequest) {
            $multi = false;
            $requests = [$requests];
        }

        $batch = $responses = [];
        foreach ($requests as $key => $request) {
            if (!($request instanceof DestinyRequest)) {
                throw new Exception('Invalid request');
            }

            if (!CACHE_ENABLED || $request->raw) {
                Cache::store('file')->forget($request->key);
            }

            if ($request->cache && Cache::store('file')->has($request->key)) {
                $responses[$key] = Cache::store('file')->get($request->key);
            } else {
                if ($this->proxyUrl !== null) {
                    if (self::$bucket === null) {
                        $this->initBucket();
                    } else {
                        if (!self::$bucket->consume(1)) {
                            $request->url = config('destiny.proxy_url').urlencode($this->domain.$this->baseUri.$request->url);
                        }
                    }
                }

                $stack = new HandlerStack();
                $stack->setHandler(new CurlHandler());
                $stack->push($this->onEnd($request->url));
                $stack->push($this->onStart($request->url));

                $req = $this->getAsync($request->url, ['handler' => $stack]);

                $batch[$key] = $req;
            }
        }

        if (count($batch)) {
            $keys = array_keys($batch);

            foreach (settle($batch)->wait() as $i => $result) {
                $key = $keys[$i];
                $request = $requests[$key];

                if ($request instanceof DestinyRequest && $request->raw) {
                    $responses[$key] = $result;
                    continue;
                }

                if ($result['state'] !== 'fulfilled') {
                    if ($request->salvageable) {
                        $responses[$key] = null;
                    } else {
                        Cache::store('file')->forget($request->key);

                        throw new DestinyException($result->getMessage(), $result->getCode(), $result);
                    }
                }

                if (isset($result['value'])) {
                    $response = json_decode($result['value']->getBody()->getContents(), true);

                    if (array_get($response, 'ErrorStatus') !== 'Success') {
                        Cache::store('file')->forget($request->key);
                        Bugsnag::setMetaData(['bungie' => $response]);

                        if (array_get($response, 'ErrorCode') === $this->destinyLegacyPlatformErrorCode) {
                            throw new \DestinyLegacyPlatformException(array_get($response, 'Message'), array_get($response, 'ErrorCode'));
                        } elseif (array_get($response, 'ErrorCode') === $this->destinyPrivacyRestriction) {
                            $response = ['private' => true];
                        } else {
                            if ($request->salvageable) {
                                $response = null;
                            } else {
                                throw new DestinyException(array_get($response, 'Message'), array_get($response, 'ErrorCode'));
                            }
                        }
                    } else {
                        $response = array_get($response, 'Response');
                    }

                    if (empty($response)) {
                        Cache::store('file')->forget($request->key);
                    }

                    if ($request->cache) {
                        Cache::store('file')->put($request->key, $response, $request->cache);
                    }

                    $responses[$key] = $response;
                }
            }
        }

        return $multi ? $responses : array_shift($responses);
    }

    private function initBucket()
    {
        $storage = new PredisStorage('destiny-throttle', Redis::connection()->client());
        $rate = new Rate(1, Rate::SECOND);
        self::$bucket = new TokenBucket(25, $rate, $storage);
        self::$bucket->bootstrap(1);
    }

    public function onStart(string $url)
    {
        return function (callable $handler) use ($url) {
            return function (Request $request, array $options) use ($handler, $url) {
                Debugbar::startMeasure($url);

                return $handler($request, $options);
            };
        };
    }

    public function onEnd(string $url)
    {
        return function (callable $handler) use ($url) {
            return function (Request $request, array $options) use ($handler, $url) {

                /** @var PromiseInterface $promise */
                $promise = $handler($request, $options);

                return $promise->then(function ($response) use ($url) {
                    Debugbar::stopMeasure($url);

                    return $response;
                });
            };
        };
    }
}

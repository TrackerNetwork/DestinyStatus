<?php

namespace Destiny;

use App\Http\Controllers\AuthController;
use App\Models\Bungie;
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
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Redis;

class DestinyClient extends Client
{
    protected $domain = 'https://www.bungie.net';
    protected $baseUri = '/Platform/';

    protected $destinyPrivacyRestriction = 1665;

    protected $proxyUrl = null;

    /** @var TokenBucket */
    public static $bucket = null;

    /**
     * DestinyClient constructor.
     *
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        // User-Agent: DestinyStatus/v3.0.0 AppId/123456 (+destinystatus.com;admin@destinystatus.com)
        $versionSlug = 'DestinyStatus/'.version();
        $appIdSlug = 'AppId/'.config('services.bungie.client_id');
        $contactSlug = 'destinystatus.com;'.config('services.bungie.contact');

        $headers = [
            'User-Agent' => $versionSlug.' '.$appIdSlug.' (+'.$contactSlug.')',
            'X-API-Key'  => $apiKey,
        ];

        if (\Auth::check()) {
            /** @var Bungie $bungie */
            $bungie = \Auth::user();

            if (!$bungie->isActive()) {
                app(AuthController::class)->handleRefreshProvider();
                $bungie->refresh();
            }

            $headers['Authorization'] = 'Bearer '.$bungie->access_token;
        }

        $config = [
            'base_uri' => $this->domain.$this->baseUri,
            'cookies'  => new FileCookieJar(storage_path('cookies')),
            'headers'  => $headers,
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
                Debugbar::startMeasure('cache: '.$request->uri);
                $responses[$key] = Cache::store('file')->get($request->key);
                Debugbar::stopMeasure('cache: '.$request->uri);
            } else {
                $request = $this->applyProxyIfNeeded($request);
                $batch[$key] = $this->applyMiddleware($request);
            }
        }

        if (count($batch)) {
            foreach (\GuzzleHttp\Promise\settle($batch)->wait() as $key => $result) {
                $request = $requests[$key];
                $state = $result['state'];

                /** @var Response $result */
                $result = $result['value'] ?? $result['reason'];

                if ($request instanceof DestinyRequest && $request->raw) {
                    $responses[$key] = $result;
                    continue;
                }

                if ($state !== 'fulfilled') {
                    if ($request->salvageable) {
                        $responses[$key] = null;
                    } else {
                        /* @var \ErrorException $result */
                        Cache::store('file')->forget($request->key);

                        throw new DestinyException($result->getMessage(), $result->getLine(), $result);
                    }
                }

                if ($result !== null) {
                    $response = json_decode($result->getBody()->getContents(), true);

                    if (array_get($response, 'ErrorStatus') !== 'Success') {
                        Cache::store('file')->forget($request->key);
                        Bugsnag::setMetaData(['bungie' => $response]);

                        if (array_get($response, 'ErrorCode') === $this->destinyPrivacyRestriction) {
                            $response = ['private' => true];
                        } else {
                            if ($request->salvageable) {
                                $response = null;
                            } else {
                                if ($response !== null) {
                                    throw new DestinyException(array_get($response, 'Message'), $result->getStatusCode());
                                } else {
                                    throw new DestinyException($result->getReasonPhrase(), $result->getStatusCode());
                                }
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
        $storage = new PredisStorage('destiny-throttle', Redis::connection()->client(''));
        $rate = new Rate(1, Rate::SECOND);
        self::$bucket = new TokenBucket(25, $rate, $storage);
        self::$bucket->bootstrap(1);
    }

    /**
     * @param DestinyRequest $request
     *
     * @return DestinyRequest
     */
    private function applyProxyIfNeeded(DestinyRequest $request): DestinyRequest
    {
        if ($this->proxyUrl !== null) {
            if (self::$bucket === null) {
                $this->initBucket();
            } else {
                if (!self::$bucket->consume(1)) {
                    $request->url = config('destiny.proxy_url').urlencode($this->domain.$this->baseUri.$request->url);
                }
            }
        }

        return $request;
    }

    /**
     * @param $request
     *
     * @return PromiseInterface
     */
    private function applyMiddleware(DestinyRequest $request): PromiseInterface
    {
        $stack = new HandlerStack();
        $stack->setHandler(new CurlHandler());
        $stack->push($this->onEnd($request->url));
        $stack->push($this->onStart($request->url));

        return $this->getAsync($request->url, ['handler' => $stack]);
    }

    //---------------------------------------------------------------------------------------
    // Middleware Events (Guzzle 6)
    //---------------------------------------------------------------------------------------

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

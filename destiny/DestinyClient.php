<?php namespace Destiny;

use Cache;
use DestinyException;
use Exception;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Pool;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\FileCookieJar;
use Barryvdh\Debugbar\Facade as Debugbar;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;

class DestinyClient extends Client
{
	protected $domain = 'https://www.bungie.net';
	protected $baseUri = '/platform/';

	protected $destinyPrivacyRestriction = 1665;
	protected $destinyLegacyPlatformErrorCode = 1670;

	public function __construct($apiKey)
	{
		$config = [
			'base_url' => $this->domain.$this->baseUri,
			'defaults' => [
				'cookies' => new FileCookieJar(storage_path('cookies')),
				'headers' => [
					'User-Agent' => 'DestinyStatus.com',
					'X-API-Key'  => $apiKey,
				],
			],
		];

		parent::__construct($config);
	}

	/**
	 * @param \Destiny\DestinyRequest[]|\Destiny\DestinyRequest $requests
	 * @throws \DestinyException
	 * @throws \Exception
	 *
	 * @return array
	 */
	public function request($requests)
	{
		$multi = true;

		if ($requests instanceof DestinyRequest)
		{
			$multi = false;
			$requests = [$requests];
		}

		$batch = $responses = [];
		foreach ($requests as $key => $request)
		{
			if ( ! ($request instanceof DestinyRequest))
			{
				throw new Exception('Invalid request');
			}

			if ( ! CACHE_ENABLED || $request->raw)
			{
				Cache::store('file')->forget($request->key);
			}

			if ($request->cache && Cache::has($request->key))
			{
				Debugbar::startMeasure("CACHE: " . $request->url);
				$responses[$key] = Cache::store('file')->get($request->key);
				Debugbar::stopMeasure("CACHE: " . $request->url);
			}
			else
			{
				$req = $this->createRequest('GET', $request->url);
				$req->getEmitter()->attach($request);

				$batch[$key] = $req;
			}
		}

		if (count($batch))
		{
			$keys = array_keys($batch);

			foreach (Pool::batch($this, $batch) as $i => $result)
			{
				$key     = $keys[$i];
				$request = $requests[$key];

				if ($request instanceof DestinyRequest && $request->raw)
				{
					$responses[$key] = $result;
					continue;
				}

				if ($result instanceof Exception)
				{
					if ($request->salvageable)
					{
						$responses[$key] = null;
					}
					else
					{
						Cache::store('file')->forget($request->key);
						throw new DestinyException($result->getMessage(), $result->getCode(), $result);
					}
				}

				if ($result instanceof Response)
				{
					$response = json_decode($result->getBody()->getContents(), true);

					if (array_get($response, 'ErrorStatus') !== 'Success')
					{
						Cache::store('file')->forget($request->key);
						Bugsnag::setMetaData(['bungie' => $response]);
						if (array_get($response, 'ErrorCode') === $this->destinyLegacyPlatformErrorCode)
						{
							throw new \DestinyLegacyPlatformException(array_get($response, 'Message'), array_get($response, 'ErrorCode'));
						}
						else if (array_get($response, 'ErrorCode') === $this->destinyPrivacyRestriction)
						{
							$response = ['private' => true];
						}
						else
						{
							if ($request->salvageable)
							{
								$response = null;
							}
							else
							{
								throw new DestinyException(array_get($response, 'Message'), array_get($response, 'ErrorCode'));
							}
						}
					}
					else
					{
						$response = array_get($response, 'Response');
					}

					if (empty($response))
					{
						Cache::store('file')->forget($request->key);
					}

					if ($request->cache)
					{
						Cache::store('file')->put($request->key, $response, $request->cache);
					}

					$responses[$key] = $response;
				}
			}
		}

		return $multi ? $responses : array_shift($responses);
	}
}

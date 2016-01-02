<?php namespace Destiny;

use Bugsnag;
use Cache;
use DestinyException;
use Exception;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Pool;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\FileCookieJar;

class DestinyClient extends Client
{
	protected $domain = 'https://www.bungie.net';
	protected $baseUri = '/platform/';

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
				Cache::forget($request->key);
			}

			if ($request->cache && Cache::has($request->key))
			{
				$responses[$key] = Cache::get($request->key);
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
					Cache::forget($request->key);
					throw new DestinyException($result->getMessage(), $result->getCode(), $result);
				}

				if ($result instanceof Response)
				{
					$response = json_decode($result->getBody()->getContents(), true);

					if (array_get($response, 'ErrorStatus') !== 'Success')
					{
						Cache::forget($request->key);
						Bugsnag::setMetaData(['bungie' => $response]);
						throw new DestinyException(array_get($response, 'Message'), array_get($response, 'ErrorCode'));
					}

					$response = array_get($response, 'Response');

					if (empty($response))
					{
						Cache::forget($request->key);
					}

					if ($request->cache)
					{
						Cache::put($request->key, $response, $request->cache);
					}

					$responses[$key] = $response;
				}
			}
		}

		return $multi ? $responses : array_shift($responses);
	}
}

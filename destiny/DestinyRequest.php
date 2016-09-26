<?php namespace Destiny;

use Barryvdh\Debugbar\Facade as Debugbar;
use GuzzleHttp\Event\SubscriberInterface;

class DestinyRequest implements SubscriberInterface
{
	/**
	 * @var string
	 */
	public $key;

	/**
	 * @var string
	 */
	public $uri;

	/**
	 * @var string
	 */
	public $url;

	/**
	 * @var array
	 */
	public $params;

	/**
	 * @var int|\DateTime
	 */
	public $cache;

	/**
	 * @var bool
	 */
	public $raw = false;

	protected $time;

	public function __construct($uri, $params = [], $cache = null)
	{
		$this->uri = $uri;

		if ( ! is_array($params))
		{
			$cache = $params;
			$params = [];
		}

		$this->params   = $params;
		$this->cache    = $cache;

		// compile url with params
		$query = array_merge(['lc' => 'en'], $this->params);

		$this->url = $this->uri.'?'.http_build_query($query);
		$this->key = 'bungie:platform:'.sha1($this->url);
	}

	public function raw()
	{
		$this->raw = true;
		$this->cache = null;
	}

	public function getEvents()
	{
		return [
			'before' => ['onStart'],
			'end'    => ['onEnd'],
		];
	}

	public function onStart()
	{
		Debugbar::startMeasure($this->url);
	}

	public function onEnd()
	{
		Debugbar::stopMeasure($this->url);
	}
}

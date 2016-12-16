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

	/**
	 * @var bool
	 */
	public $salvageable = true;

	protected $time;

	public function __construct($uri, $params = [], $cache = null, $salvageable = true)
	{
		$this->uri = $uri;

		if (is_bool($params))
		{
			$salvageable = $params;
			$params = [];
		}
		else if ($params === null)
		{
			$params = [];
		}
		else if ( ! is_array($params))
		{
			$salvageable = ($cache === null) ? true : $cache;
			$cache = $params;
			$params = [];
		}

		$this->params   = $params;
		$this->cache    = $cache;

		// compile url with params
		$query = array_merge(['lc' => 'en'], $this->params);

		$this->url = $this->uri.'?'.http_build_query($query);
		$this->key = 'bungie:platform:'.sha1($this->url);
		$this->salvageable = $salvageable;
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

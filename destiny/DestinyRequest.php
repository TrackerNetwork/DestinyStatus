<?php

namespace Destiny;

use GuzzleHttp\Psr7\Request;

/**
 * Class DestinyRequest.
 *
 * @property string $key
 * @property string $uri
 * @property string $url
 * @property array $params
 * @property \DateTime|int $cache
 * @property bool $raw
 * @property bool $salvageable
 */
class DestinyRequest extends Request
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

    /**
     * DestinyRequest constructor.
     *
     * @param string $uri
     * @param array  $params
     * @param null   $cache
     * @param bool   $salvageable
     */
    public function __construct($uri, $params = [], $cache = null, $salvageable = true)
    {
        $this->uri = $uri;

        if (is_bool($params)) {
            $salvageable = $params;
            $params = [];
        } elseif ($params === null) {
            $params = [];
        } elseif (!is_array($params)) {
            $salvageable = ($cache === null) ? true : $cache;
            $cache = $params;
            $params = [];
        }

        $this->params = $params;
        $this->cache = $cache;

        // compile url with params
        $query = array_merge(['lc' => 'en'], $this->params);

        $this->url = $this->uri.'?'.http_build_query($query);
        $this->key = 'bungie:platform:'.sha1($this->url).\Auth::check();
        $this->salvageable = $salvageable;
    }

    public function raw()
    {
        $this->raw = true;
        $this->cache = null;
    }
}

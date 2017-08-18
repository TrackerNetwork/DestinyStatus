<?php

namespace Destiny;

use Barryvdh\Debugbar\Facade as Debugbar;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

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

    protected $time;

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
        $this->key = 'bungie:platform:'.sha1($this->url);
        $this->salvageable = $salvageable;
    }

    public function raw()
    {
        $this->raw = true;
        $this->cache = null;
    }
}

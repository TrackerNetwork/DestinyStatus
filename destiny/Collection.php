<?php

namespace Destiny;

/**
 * Class Collection
 * @package Destiny
 */
class Collection extends \Illuminate\Support\Collection
{
    /**
     * @param string $key
     * @return mixed
     */
    public function __get($key)
    {
        $mutator = 'g'.studly_case($key);

        if (method_exists($this, $mutator)) {
            return call_user_func([$this, $mutator]);
        }

        return $this->offsetGet($key);
    }
}
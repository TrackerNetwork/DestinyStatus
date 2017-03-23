<?php

namespace Destiny;

class Collection extends \Illuminate\Support\Collection
{
    public function __get($key)
    {
        $mutator = 'g'.studly_case($key);

        if (method_exists($this, $mutator)) {
            return call_user_func([$this, $mutator]);
        }

        return $this->offsetGet($key);
    }
}

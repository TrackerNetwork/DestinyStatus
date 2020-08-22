<?php

namespace Destiny;

use Illuminate\Support\Str;

/**
 * Class Collection.
 */
class Collection extends \Illuminate\Support\Collection
{
    /**
     * @param string $key
     *
     * @return mixed
     */
    public function __get($key)
    {
        $mutator = 'g'.Str::studly($key);

        if (method_exists($this, $mutator)) {
            return call_user_func([$this, $mutator]);
        }

        return $this->offsetGet($key);
    }
}

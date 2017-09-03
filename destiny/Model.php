<?php

namespace Destiny;

use ArrayAccess;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use JsonSerializable;

/**
 * Class Model.
 */
abstract class Model implements JsonSerializable, Arrayable, ArrayAccess
{
    protected $properties = [];
    protected $appends = [];
    protected $cached = [];

    public function __construct(array $properties)
    {
        $this->properties = $properties;
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    public function __toString()
    {
        return json_encode($this->toArray());
    }

    public function __get($key)
    {
        return $this->getProperty($key);
    }

    public function __set($key, $value)
    {
        $mutator = 's'.$key;

        if (is_callable([$this, $mutator])) {
            $this->$mutator($value);
        } else {
            $this->setProperty($key, $value);
        }
    }

    public function __isset($key)
    {
        return isset($this->properties[$key]) || isset($this->cached[$key]);
    }

    public function __unset($key)
    {
        unset($this->properties[$key]);
    }

    public function offsetExists($offset)
    {
        return $this->__isset($offset);
    }

    public function offsetGet($offset)
    {
        return $this->__get($offset);
    }

    public function offsetSet($offset, $value)
    {
        $this->__set($offset, $value);
    }

    public function offsetUnset($offset)
    {
        $this->__unset($offset);
    }

    public function getProperties()
    {
        $properties = [];

        foreach ($this->properties as $key => $value) {
            $properties[$key] = $this->$key;
        }

        foreach ($this->appends as $key) {
            $properties[$key] = $this->$key;
        }

        return $properties;
    }

    protected function getProperty($key)
    {
        if (isset($this->cached[$key])) {
            return $this->cached[$key];
        }

        $value = (isset($this->properties[$key]) ? $this->properties[$key] : null);
        $mutator = 'g'.ucfirst($key);

        if (is_callable([$this, $mutator])) {
            $this->cached[$key] = $value = $this->$mutator($value);
        }

        return $value;
    }

    protected function getNonMutatedProperty($key)
    {
        if (isset($this->cached[$key])) {
            return $this->cached[$key];
        }

        $value = (isset($this->properties[$key]) ? $this->properties[$key] : null);

        return $value;
    }

    protected function setProperty($key, $value)
    {
        $this->properties[$key] = $value;
    }

    protected function setCachedProperty($key, $value)
    {
        return $this->cached[$key] = $value;
    }

    protected function newCollection(array $items = [])
    {
        return new Collection($items);
    }

    public function toArray()
    {
        $array = [];
        $properties = array_merge(array_keys($this->properties), $this->appends);

        foreach ($properties as $key) {
            $property = $this->getProperty($key);

            if ($property instanceof Arrayable) {
                $property = $property->toArray();
            }

            $array[$key] = $property;
        }

        return $array;
    }
}

<?php

namespace Destiny\Definitions;

use Destiny\Model;

/**
 * Class Definition
 * @package Destiny\Definitions
 * @property array $properties
 * @property array $cached
 */
class Definition extends Model
{
    /**
     * Definition constructor.
     * @param array|null $definition
     */
    public function __construct(array $definition = null)
    {
        parent::__construct($definition ?: []);
    }

    /**
     * @param Definition $definition
     */
    protected function extend(Definition $definition)
    {
        $this->properties = array_merge($this->properties, $definition->properties);
        $this->cached = array_merge($this->cached, $definition->cached);
    }
}
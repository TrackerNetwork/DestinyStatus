<?php

namespace Destiny\Definitions\Stat;

use Destiny\Definitions\Manifest\Stat as StatDefinition;

/**
 * Class Entry
 * @package Destiny\Definition\Stat
 * @property string $value
 */
class Entry extends StatDefinition
{
    public function __construct(array $definition, string $value)
    {
        $definition['value'] = $value;
        parent::__construct($definition);
    }
}

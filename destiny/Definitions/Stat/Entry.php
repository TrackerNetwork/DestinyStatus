<?php

namespace Destiny\Definitions\Stat;

use Destiny\Definitions\Manifest\Stat as StatDefinition;

/**
 * Class Entry.
 *
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

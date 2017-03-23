<?php

namespace Destiny\Character;

use Destiny\Definitions\Stat as StatDefinition;

/**
 * @property int $value
 * @property int $minimum
 * @property int $maximum
 *
 * {@inheritdoc}
 */
class Stat extends StatDefinition
{
    public function __construct(array $properties)
    {
        $definition = manifest()->stat($properties['statHash']);
        $properties = array_merge($definition->getProperties(), $properties);

        parent::__construct($properties);
    }
}

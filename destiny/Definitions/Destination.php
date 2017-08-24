<?php

namespace Destiny\Definitions;

use Destiny\Definitions\Common\DisplayProperties;

/**
 * Class Destination
 * @package Destiny\Definitions
 * @property DisplayProperties $displayProperties
 * @property string $placeHash (Place)
 * @property string $defaultFreeroamActivityHash (Activity)
 * @property (@todo - https://bungie-net.github.io/multi/schema_Destiny-Definitions-DestinyDestinationDefinition.html#schema_Destiny-Definitions-DestinyDestinationDefinition)
 *
 */
class Destination extends Definition
{
    protected $appends = [
        'displayProperties',
    ];
}
<?php

namespace Destiny\Definitions\Manifest;

use Destiny\Definitions\Common\ProgressionDisplayProperties;
use Destiny\Definitions\Definition;

/**
 * Class Progression
 * @package Destiny\Definitions\Manifest
 * @property ProgressionDisplayProperties $displayProperties
 * @property int $scope
 * @property bool $repeatLastStep
 * @property string $source
 * @property array $steps (@todo - https://bungie-net.github.io/multi/schema_Destiny-Definitions-DestinyProgressionStepDefinition.html#schema_Destiny-Definitions-DestinyProgressionStepDefinition)
 * @property bool $visible
 * @property string $factionHash (@todo - https://bungie-net.github.io/multi/schema_Destiny-Definitions-DestinyFactionDefinition.html#schema_Destiny-Definitions-DestinyFactionDefinition)
 * @property string $hash
 * @property int $index
 * @property bool $redacted
 */
class Progression extends Definition
{
    protected $appends = [
        'displayProperties',
    ];
}
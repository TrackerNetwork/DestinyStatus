<?php

namespace Destiny\Definitions\Manifest;

use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;

/**
 * Class Objective.
 *
 * @property array $displayProperties
 * @property int $completionValue
 * @property string $locationHash
 * @property bool $allowNegativeValue
 * @property bool $allowValueChangeWhenCompleted
 * @property bool $isCountingDownward
 * @property int $valueStyle
 * @property string $progressDescription
 * @property array $perks (@todo - https://bungie-net.github.io/multi/schema_Destiny-Definitions-DestinyObjectivePerkEntryDefinition.html#schema_Destiny-Definitions-DestinyObjectivePerkEntryDefinition)
 * @property array $stats (@todo - https://bungie-net.github.io/multi/schema_Destiny-Definitions-DestinyObjectiveStatEntryDefinition.html#schema_Destiny-Definitions-DestinyObjectiveStatEntryDefinition)
 * @property string $hash
 * @property int $index
 * @property bool $redacted
 * @property DisplayProperties $display
 */
class Objective extends Definition
{
    protected $appends = [
        'display',
    ];

    protected function gDisplay()
    {
        return new DisplayProperties($this->displayProperties);
    }
}

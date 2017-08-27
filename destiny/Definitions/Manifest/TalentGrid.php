<?php

namespace Destiny\Definitions\Manifest;

use Destiny\Definitions\Definition;

/**
 * Class TalentGrid.
 *
 * @property int $maxGridLevel
 * @property int $gridLevelPerColumn
 * @property string $progressionHash
 * @property array $nodes (@todo - https://bungie-net.github.io/multi/schema_Destiny-Definitions-DestinyTalentNodeDefinition.html#schema_Destiny-Definitions-DestinyTalentNodeDefinition)
 * @property array $exclusiveSets (@todo - https://bungie-net.github.io/multi/schema_Destiny-Definitions-DestinyTalentNodeExclusiveSetDefinition.html#schema_Destiny-Definitions-DestinyTalentNodeExclusiveSetDefinition)
 * @property array $independentNodeIndexes
 * @property array $groups
 * @property array $nodeCategories
 * @property string $hash
 * @property int $index
 * @property bool $redacted
 */
class TalentGrid extends Definition
{
    protected $appends = [
        'displayProperties',
    ];
}

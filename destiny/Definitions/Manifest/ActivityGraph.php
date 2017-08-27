<?php

namespace Destiny\Definitions\Manifest;

use Destiny\Definitions\Definition;

/**
 * Class ActivityGraph
 * @package Destiny\Definitions\Manifest
 * @property array $nodes (@todo - https://bungie-net.github.io/multi/schema_Destiny-Definitions-Director-DestinyActivityGraphNodeDefinition.html#schema_Destiny-Definitions-Director-DestinyActivityGraphNodeDefinition)
 * @property array $artElements (@todo - https://bungie-net.github.io/multi/schema_Destiny-Definitions-Director-DestinyActivityGraphArtElementDefinition.html#schema_Destiny-Definitions-Director-DestinyActivityGraphArtElementDefinition)
 * @property array $connections (@todo - https://bungie-net.github.io/multi/schema_Destiny-Definitions-Director-DestinyActivityGraphConnectionDefinition.html#schema_Destiny-Definitions-Director-DestinyActivityGraphConnectionDefinition)
 * @property array $displayObjectives (@todo - https://bungie-net.github.io/multi/schema_Destiny-Definitions-Director-DestinyActivityGraphDisplayObjectiveDefinition.html#schema_Destiny-Definitions-Director-DestinyActivityGraphDisplayObjectiveDefinition)
 * @property array $displayProgressions (@todo - https://bungie-net.github.io/multi/schema_Destiny-Definitions-Director-DestinyActivityGraphDisplayProgressionDefinition.html#schema_Destiny-Definitions-Director-DestinyActivityGraphDisplayProgressionDefinition)
 * @property array $linkedGraphs (@todo - https://bungie-net.github.io/multi/schema_Destiny-Definitions-Director-DestinyLinkedGraphDefinition.html#schema_Destiny-Definitions-Director-DestinyLinkedGraphDefinition)
 * @property string $hash
 * @property int $index
 * @property bool $redacted
 */
class ActivityGraph extends Definition
{
    protected $appends = [
    ];
}
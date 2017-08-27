<?php

namespace Destiny\Definitions\Manifest;

use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;

/**
 * Class SandboxPerk
 * @package Destiny\Definitions\Manifest
 * @property DisplayProperties $displayProperties
 * @property string $perkIdentifier
 * @property bool $isDisplayable
 * @property int $damageType
 * @property string $damageTypeHash
 * @property array $perkGroups (@todo - https://bungie-net.github.io/multi/schema_Destiny-Definitions-DestinyTalentNodeStepGroups.html#schema_Destiny-Definitions-DestinyTalentNodeStepGroups)
 * @property string $hash
 * @property int $index
 * @property bool $redacted
 */
class SandboxPerk extends Definition
{
    protected $appends = [
        'displayProperties',
    ];
}
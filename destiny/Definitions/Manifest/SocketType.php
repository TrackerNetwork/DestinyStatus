<?php

namespace Destiny\Definitions\Manifest;

use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;


/**
 * Class SocketType
 * @package Destiny\Definitions\Manifest
 * @property DisplayProperties $displayProperties
 * @property array $insertAction (@todo - https://bungie-net.github.io/multi/schema_Destiny-Definitions-Sockets-DestinyInsertPlugActionDefinition.html#schema_Destiny-Definitions-Sockets-DestinyInsertPlugActionDefinition)
 * @property array $plugWhitelist (@todo - https://bungie-net.github.io/multi/schema_Destiny-Definitions-Sockets-DestinyPlugWhitelistEntryDefinition.html#schema_Destiny-Definitions-Sockets-DestinyPlugWhitelistEntryDefinition)
 * @property string $socketCategoryHash
 * @property int $visibility
 * @property string $hash
 * @property int $index
 * @property bool $redacted
 */
class SocketType extends Definition
{
    protected $appends = [
        'displayProperties'
    ];
}
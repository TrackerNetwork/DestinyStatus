<?php

namespace Destiny\Definitions\Manifest;

use Destiny\Definitions\Definition;

/**
 * Class Location.
 *
 * @property string $vendorHash       (Manifest/Vendor)
 * @property array  $locationReleases (@todo - https://bungie-net.github.io/multi/schema_Destiny-Definitions-DestinyLocationReleaseDefinition.html#schema_Destiny-Definitions-DestinyLocationReleaseDefinition)
 * @property string $hash
 * @property int    $index
 * @property bool   $redacted
 */
class Location extends Definition
{
    protected $appends = [
        'displayProperties',
    ];
}

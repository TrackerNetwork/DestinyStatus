<?php

namespace Destiny\Definitions\Manifest;

use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;

/**
 * Class DestinyClass
 * @package Destiny\Definitions\Manifest
 * @property int $classType
 * @property DisplayProperties $displayProperties
 * @property array $genderedClassNames
 * @property array $mentorVendorHash
 * @property string $hash
 * @property int $index
 * @property bool $redacted
 */
class DestinyClass extends Definition
{
    protected $appends = [
        'displayProperties',
    ];
}
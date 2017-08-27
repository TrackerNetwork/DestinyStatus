<?php

namespace Destiny\Definitions\Manifest;

use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;

/**
 * Class Lore
 * @package Destiny\Definitions\Manifest
 * @property DisplayProperties $displayProperties
 * @property string $subtitle
 * @property string $hash
 * @property int $index
 * @property bool $redacted
 */
class Lore extends Definition
{
    protected $appends = [
        'displayProperties',
    ];
}
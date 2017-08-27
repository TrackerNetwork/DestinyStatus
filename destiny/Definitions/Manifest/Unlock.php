<?php

namespace Destiny\Definitions\Manifest;

use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;

/**
 * Class Unlock
 * @package Destiny\Definitions\Manifest
 * @property DisplayProperties $displayProperties
 * @property string $hash
 * @property int $index
 * @property bool $redacted
 */
class Unlock extends Definition
{
    protected $appends = [
        'displayProperties'
    ];
}
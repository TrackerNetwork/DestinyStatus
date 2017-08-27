<?php

namespace Destiny\Definitions\Manifest;

use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;

/**
 * Class Gender
 * @package Destiny\Definitions\Manifest
 * @property DisplayProperties $displayProperties
 * @property string $hash
 * @property int $index
 * @property bool $redacted
 */
class Gender extends Definition
{
    protected $appends = [
        'displayProperties',
    ];
}
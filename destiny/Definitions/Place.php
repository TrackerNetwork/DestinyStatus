<?php

namespace Destiny\Definitions;

use Destiny\Definitions\Common\DisplayProperties;

/**
 * Class Place
 * @package Destiny\Definitions
 * @property DisplayProperties $displayProperties
 * @property string $hash
 * @property int $index
 * @property bool $redacted
 */
class Place extends Definition
{
    protected $appends = [
        'displayProperties',
    ];
}
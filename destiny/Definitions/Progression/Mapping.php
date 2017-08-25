<?php

namespace Destiny\Definitions\Progression;

use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;

/**
 * Class Mapping
 * @package Destiny\Definitions\Progression
 * @property DisplayProperties $displayProperties
 * @property string $displayUnits
 * @property string $hash
 * @property int $index
 * @property bool $redacted
 */
class Mapping extends Definition
{
    protected $appends = [
        'displayProperties'
    ];
}
<?php

namespace Destiny\Definitions;

use Destiny\Definitions\Common\DisplayProperties;


/**
 * Class ActivityType
 * @package Destiny\Definitions
 * @property DisplayProperties $displayProperties
 * @property string $hash
 * @property int $index
 * @property bool $redacted
 */
class ActivityType extends Definition
{
    protected $appends = [
        'displayProperties'
    ];
}
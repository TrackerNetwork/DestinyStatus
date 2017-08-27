<?php

namespace Destiny\Definitions\Manifest;

use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;


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
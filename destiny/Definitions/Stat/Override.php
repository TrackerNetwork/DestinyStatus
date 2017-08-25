<?php

namespace Destiny\Definition\Stat;

use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;

/**
 * Class Override
 * @package Destiny\Definition\Stat
 * @property string $statHash
 * @property DisplayProperties $displayProperties
 */
class Override extends Definition
{
    protected $appends = [
        'displayProperties'
    ];
}
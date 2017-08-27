<?php

namespace Destiny\Definitions\Manifest;

use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;

/**
 * Class RewardSource
 * @package Destiny\Definitions\Manifest
 * @property DisplayProperties $displayProperties
 * @property int $category
 * @property string $hash
 * @property int $index
 * @property bool $redacted
 */
class RewardSource extends Definition
{
    protected $appends = [
        'displayProperties',
    ];
}
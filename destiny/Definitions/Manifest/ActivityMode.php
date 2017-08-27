<?php

namespace Destiny\Definitions\Manifest;

use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;

/**
 * Class ActivityMode
 * @package Destiny\Definitions\Manifest
 * @property DisplayProperties $displayProperties
 * @property string $pgcrImage
 * @property int $modeType
 * @property int $activityModeCategory
 * @property array $parentHashes
 * @property string $friendlyName
 * @property array $activityModelMappings
 * @property bool $display
 * @property int $order
 * @property string $hash
 * @property int $index
 * @property bool $redacted
 */
class ActivityMode extends Definition
{
    protected $appends = [
        'displayProperties'
    ];
}
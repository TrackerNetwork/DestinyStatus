<?php

namespace Destiny\Definitions\Manifest;

use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;

/**
 * Class ItemTierType
 * @package Destiny\Definitions\Manifest
 * @property DisplayProperties $displayProperties
 * @property array $infusionProcess (TierTypeInfusionBlock)
 * @property string $hash
 * @property int $index
 * @property bool $redacted
 */
class ItemTierType extends Definition
{
    protected $appends = [
        'displayProperties',
    ];
}
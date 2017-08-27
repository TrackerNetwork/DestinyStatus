<?php

namespace Destiny\Definitions\Manifest;

use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;

/**
 * Class HistoricalStat
 * @package Destiny\Definitions\Manifest
 * @property string $statId
 * @property int $group
 * @property array $periodTypes
 * @property array $modes
 * @property int $category
 * @property string $statName
 * @property string $statDescription
 * @property int $unitType
 * @property string $iconImage
 * @property int $mergeMethod
 * @property string $unitLabel
 * @property int $weight
 * @property string $medalTierHash
 */
class HistoricalStat extends Definition
{
    protected $appends = [
        'displayProperties',
    ];
}
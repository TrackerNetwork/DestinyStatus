<?php

namespace Destiny\Definitions\Progression;

use Destiny\Definitions\Definition;

/**
 * Class Reward
 * @package Destiny\Definitions\Progression
 * @property string $progressionMappingHash
 * @property int $amount
 * @property bool $applyThrottles
 * @property-read Mapping $progressionMapping
 */
class Reward extends Definition
{
    protected $appends = [
        'progressionMapping'
    ];

    protected function gProgressionMapping()
    {
        //return destiny()->progressionMapping($this->progressionMappingHash);
    }
}
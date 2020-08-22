<?php

namespace Destiny\Definitions\Progression;

use Destiny\Definitions\Definition;

/**
 * Class Reward.
 *
 * @property string $progressionMappingHash
 * @property int    $amount
 * @property bool   $applyThrottles
 * @property-read Mapping $progressionMapping
 */
class Reward extends Definition
{
    protected $appends = [
        'progressionMapping',
    ];

    protected function gProgressionMapping()
    {
        //return app('destiny')->progressionMapping($this->progressionMappingHash);
    }
}

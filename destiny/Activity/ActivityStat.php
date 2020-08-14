<?php

namespace Destiny\Activity;

use Destiny\Definitions\Definition;
use Destiny\StatisticsCollection;

/**
 * @property string               $activityHash
 * @property array                $values
 * @property StatisticsCollection $stats
 */
class ActivityStat extends Definition
{
    protected function gDefinition()
    {
        return manifest()->activity($this->activityHash);
    }

    protected function gStats()
    {
        return new StatisticsCollection($this->values ?? []);
    }
}

<?php

namespace Destiny\Definitions\Components;

use Destiny\Definitions\Definition;

/**
 * Class Activity.
 *
 * @property string $dateActivityStarted
 * @property array  $availableActivities
 * @property string $currentActivityHash
 * @property string $currentActivityModeHash
 * @property string $lastCompletedStoryHash
 */
class Activity extends Definition
{
    protected $appends = [
        '',
    ];
}

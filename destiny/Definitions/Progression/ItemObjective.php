<?php

namespace Destiny\Definitions\Progression;

use Destiny\Definitions\Definition;

/**
 * Class ItemObjective
 * @package Destiny\Definitions\Progression
 * @property string $objectiveHash
 * @property string $destinationHash
 * @property string $activityHash
 * @property int $progress
 * @property bool $complete
 */
class ItemObjective extends Definition
{
    protected $appends = [
    ];
}

<?php

namespace Destiny\Definitions\Progression;

use Destiny\Definitions\Definition;

/**
 * Class Quest.
 *
 * @property string   $questItemHash
 * @property Status   $status
 * @property Activity $activity
 * @property array    $variants
 * @property Status   $instance
 * @property-read int $activityLevel
 * @property-read bool $completed
 */
class Quest extends Definition
{
    protected $appends = [
    ];

    protected function gStatus()
    {
        return new Status($this->getNonMutatedProperty('status'));
    }

    protected function gActivity()
    {
        return new Activity($this->getNonMutatedProperty('activity') ?? []);
    }

    protected function gActivityLevel()
    {
        return $this->activity->definition->activityLevel;
    }

    protected function gCompleted()
    {
        return $this->status->completed;
    }
}

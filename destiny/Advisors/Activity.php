<?php

namespace Destiny\Advisors;

use Carbon\Carbon;
use Destiny\Advisors;
use Destiny\Definitions\Activity as ActivityDefinition;

/**
 * @property \Destiny\Advisors\ActivityLevel[] $rewards
 * @property \Destiny\Skull[] $skulls
 * @property \Carbon\Carbon $resetDate
 * @property int $minutesUntilReset
 * @property \Destiny\Definitions\Destination $destination
 */
class Activity extends ActivityDefinition
{
    public function __construct(Advisors $advisors, ActivityDefinition $definition, Carbon $resetDate)
    {
        $this->extend($definition);
        $this->resetDate = $resetDate;
        $this->rewards = $this->newCollection();
    }

    protected function gMinutesUntilReset()
    {
        return $this->resetDate->diffInMinutes();
    }

    public function addLevelRewards(ActivityDefinition $definition)
    {
        $level = new ActivityLevel($definition);

        $this->rewards->put($definition->activityLevel, $level);
    }

    public function addActiveSkulls(ActivityDefinition $definition, array $skulls)
    {
        $activitySkulls = $definition->getNonMutatedProperty('skulls');

        if (is_array($activitySkulls)) {
            foreach ($activitySkulls as $key => $skull) {
                if (!in_array($key, $skulls)) {
                    unset($definition->properties['skulls'][$key]);
                }
            }
        }

        $this->skulls = $definition->getNonMutatedProperty('skulls');
    }
}

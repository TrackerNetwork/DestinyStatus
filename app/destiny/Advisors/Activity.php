<?php namespace Destiny\Advisors;

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
}

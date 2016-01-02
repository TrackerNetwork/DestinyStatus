<?php namespace Destiny\Advisors;

use Destiny\Definitions\Activity as ActivityDefinition;
use Destiny\Model;

/**
 * @property int $level
 * @property \Destiny\Advisors\Reward[] $rewards
 * @property \Destiny\Definitions\Activity $definition
 */
class ActivityLevel extends Model
{
	protected $definition;

	public function __construct(ActivityDefinition $definition)
	{
		$this->definition = $definition;
		$this->level = $definition->activityLevel;
		$this->rewards = $this->newCollection();

		foreach ($definition->rewards as $rewardItemsArray)
		{
			foreach ($rewardItemsArray['rewardItems'] as $properties)
			{
				$reward = new Reward($this, $properties);
				$this->rewards->put($reward->itemHash, $reward);
			}
		}
	}

	protected function gDefinition()
	{
		return $this->definition;
	}
}

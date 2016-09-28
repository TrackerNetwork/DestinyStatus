<?php namespace Destiny\AdvisorsTwo;

use Destiny\Character;
use Destiny\Definitions\Activity as ActivityDefinition;
use Destiny\Definitions\ActivityData;
use Destiny\Definitions\Objective;
use Destiny\Definitions\SkullModifier;
use Destiny\Model;

/**
 * @property string $activityHash
 * @property string $tierDisplayName
 * @property string $activityName
 * @property string $iconPath
 *
 * @property ActivityDefinition $activity
 * @property ActivityData $data
 * @property ActivityData $activityData
 * @property Reward[] $rewards
 * @property Objective[] $objectives
 * @property ArenaRound[] $rounds
 * @property Completion $completion
 *
 * @property ActivityDefinition $definition
 * @property SkullModifier[] $skulls
 */
class ActivityTier extends Model
{
	/** @var bool $raid */
	private $raid = false;

	/** @var array $skippedRewards */
	private $skippedRewards = [
		3653611614, // Weekly Bonus - 3
		2488248952, // Weekly Bonus - 2
		949183486, // Weekly Bonus - 1
	];

	public function __construct(array $properties)
	{
		$properties['definition'] = manifest()->activity($properties['activityHash']);
		$properties['activityData'] = new ActivityData($properties['activityData']);

		if (isset($properties['extended']['rounds']))
		{
			$rounds = [];
			foreach ($properties['extended']['rounds'] as $k => $round)
			{
				$round = new ArenaRound($this, $round);
				$round->roundNumber = $k + 1;

				$rounds[$round->roundNumber] = $round;
			}
			$properties['rounds'] = $rounds;
		}

		if (isset($properties['rewards']))
		{
			$rewards = [];
			foreach ($properties['rewards'] as $rewardGroup)
			{
				foreach ($rewardGroup['rewardItems'] as $item)
				{
					if (! in_array($item['itemHash'], $this->skippedRewards))
					{
						$rewards[] = new Reward($properties['activityData']->displayLevel, $item);
					}
				}
			}
			$properties['rewards'] = $rewards;
		}

		if (isset($properties['extended']['skullCategories']))
		{
			$skulls = [];
			foreach ($properties['extended']['skullCategories'] as $skullCategory)
			{
				foreach ($skullCategory['skulls'] as $skull)
				{
					$skull = new SkullModifier($skull);
					$skull->isModifier = $skullCategory['title'] === "Modifiers";
					$skulls[] = $skull;
				}
			}
			$properties['skulls'] = $skulls;
		}

		if (isset($properties['skullCategories']))
		{
			$skulls = [];
			foreach ($properties['skullCategories'] as $skullCategory)
			{
				foreach ($skullCategory['skulls'] as $skull)
				{
					$skull = new SkullModifier($skull);
					$skull->isModifier = $skullCategory['title'] === "Modifiers";
					$skulls[] = $skull;
				}
			}

			// Add heroic skull if HM
			if ($properties['tierDisplayName'] === "Hard")
			{
				$skulls[] = $properties['definition']->skulls->first();
			}

			$properties['skulls'] = $skulls;
			$this->raid = true;
		}

		if (isset($properties['completion']))
		{
			$properties['completion'] = new Completion($properties['completion']);
		}

		parent::__construct($properties);
	}

	protected function gObjectives()
	{
		return $this->activity->objectives;
	}

	protected function gSkulls()
	{
		if ($this->raid)
		{
			return $this->getNonMutatedProperty('skulls');
		}
		return $this->activity->skulls;
	}

	protected function gActivity()
	{
		return $this->definition;
	}

	protected function gData()
	{
		return $this->activityData;
	}

	protected function gActivityName()
	{
		return $this->definition->activityName;
	}

	protected function gIconPath()
	{
		return $this->definition->icon;
	}

	public function toActivity(Character $character, array $stats)
	{
		$activityHash = $this->definition->activityHash;
		$stat = null;

		if (isset($stats[$activityHash]))
		{
			$stat = $stats[$activityHash];
		}

		return new Character\Activity($character, $this->definition->toArray(), $stat, $this->completion);
	}
}
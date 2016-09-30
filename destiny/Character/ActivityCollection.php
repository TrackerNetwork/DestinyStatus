<?php namespace Destiny\Character;

use Destiny\Advisors;
use Destiny\AdvisorsTwo\ActivityTier;
use Destiny\Character;
use Destiny\Collection;
use Destiny\StatisticsCollection;

/**
 * @property boolean $private
 * @method \Destiny\Character\Activity offsetGet($key)
 */
class ActivityCollection extends Collection
{
	/**
	 * @var \Destiny\Character
	 */
	protected $character;

	public function __construct(Character $character, array $stats, array $checklist)
	{
		$this->character = $character;
		if (count($checklist) === 0)
		{
			return;
		}

		$advisors = new Advisors($checklist);

		// stats grouped by activity hash
		$statsArray = [];
		foreach ($stats as $k => $stat)
		{
			$activityHash = (string) $stat['activityHash'];
			$statsArray[$activityHash] = new StatisticsCollection($stat['values']);
		}

		// Weekly Nightfall
		$nightfall = $advisors->nightfall->toActivity($character, $statsArray);
		$this->put('NIGHTFALL', $nightfall);

		// Daily PVE/PVP
		$dailyChapter = $advisors->dailychapter->toActivity($character, $statsArray);
		$this->put('DAILY_PVE', $dailyChapter);

		$dailyCrucible = $advisors->dailycrucible->toActivity($character, $statsArray);
		$this->put('DAILY_PVP', $dailyCrucible);

		/** @var ActivityTier $activityTier */
		foreach ($advisors->vaultofglass->activityTiers as $activityTier)
		{
			/** @var ActivityTier $activity */
			$activity = $activityTier->toActivity($character, $statsArray);
			$activity->activityMode = $activityTier->tierDisplayName;
			$this->put('RAID_' . $activity->activityHash, $activity);
		}

		foreach ($advisors->crota->activityTiers as $activityTier)
		{
			/** @var Activity $activity */
			$activity = $activityTier->toActivity($character, $statsArray);
			$activity->activityMode = $activityTier->tierDisplayName;
			$this->put('RAID_' . $activity->activityHash, $activity);
		}

		foreach ($advisors->kingsfall->activityTiers as $activityTier)
		{
			/** @var Activity $activity */
			$activity = $activityTier->toActivity($character, $statsArray);
			$activity->activityMode = $activityTier->tierDisplayName;
			$this->put('RAID_' . $activity->activityHash, $activity);
		}

		foreach ($advisors->wrathofthemachine->activityTiers as $activityTier)
        {
            /** @var Activity $activity */
            $activity = $activityTier->toActivity($character, $statsArray);
            $activity->activityMode = $activityTier->tierDisplayName;
            $this->put('RAID_' . $activity->activityHash, $activity);
        }

		foreach ($advisors->elderchallenge->activityTiers as $activityTier)
		{
			/** @var Activity $activity */
			$activity = $activityTier->toActivity($character, $statsArray);
			$this->put('ARENA_' . $activity->activityHash, $activity);
		}

		foreach ($advisors->prisonofelders->activityTiers as $activityTier)
		{
			/** @var Activity $activity */
			$activity = $activityTier->toActivity($character, $statsArray);
			$this->put('ARENA_' . $activity->activityHash, $activity);
		}
	}

	protected function gWeekly()
	{
		$items = [];

		foreach ($this as $k => $activity)
		{
			if ($activity->isWeekly())
			{
				$items[$k] = $activity;
			}
		}

		return $items;
	}

	protected function gWeeklyStrikes()
	{
		$items = [];

		foreach ($this as $k => $activity)
		{
			if ($activity->isWeeklyHeroic() || $activity->isNightfall())
			{
				$items[$k] = $activity;
			}
		}

		return $items;
	}

	protected function gDailyAndNightfall()
	{
		$items = [];

		/**
		 * @var string $k
		 * @var Activity $activity
		 */
		foreach($this as $k => $activity)
		{
			if (starts_with($k, 'DAILY') || starts_with($k, 'NIGHTFALL'))
			{
				$items[$activity->activityHash] = $activity;
			}
		}

		return $items;
	}

	protected function gWeeklyRaids()
	{
		$items = [];

		/**
		 * @var string $k
		 * @var Activity $activity
		 */
		foreach($this as $k => $activity)
		{
			if (starts_with($k, 'RAID'))
			{
				$items[$activity->activityHash] = $activity;
			}
		}

		return $items;
	}

	protected function gWeeklyArenas()
	{
		$items = [];

		/**
		 * @var string $k
		 * @var Activity $activity
		 */
		foreach($this as $k => $activity)
		{
			if (starts_with($k, 'ARENA'))
			{
				$items[$activity->activityHash] = $activity;
			}
		}

		return $items;
	}
}

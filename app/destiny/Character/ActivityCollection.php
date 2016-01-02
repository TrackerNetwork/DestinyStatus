<?php namespace Destiny\Character;

use Destiny\Character;
use Destiny\Collection;
use Destiny\StatisticsCollection;

/**
 * @method \Destiny\Character\Activity offsetGet($key)
 */
class ActivityCollection extends Collection
{
	/**
	 * @var \Destiny\Character
	 */
	protected $character;

	/**
	 * @var \Carbon\Carbon
	 */
	public $dateActivityStarted;

	public function __construct(Character $character, array $activities, array $raids, array $arenas, array $stats)
	{
		$this->character = $character;
		$this->dateActivityStarted = carbon($activities['dateActivityStarted']);

		$lastReset = last_weekly();
		$nextReset = next_weekly();

		// raid completion status
		$raidsCompleted = [];
		foreach ($raids as $raid)
		{
			$activityHash  = (string) $raid['activityDetails']['referenceId'];
			$activity      = manifest()->activity($activityHash);
			$activityId    = sha1($activity->activityName);
			$activityLevel = $activity->activityLevel;

			$completed = (bool) array_get($raid, 'values.completed.basic.value', false);
			$date = carbon($raid['period']);

			if ( ! isset($raidsCompleted[$activityId]))
			{
				$raidsCompleted[$activityId] = null;
			}

			if ($completed && $date > $lastReset && $date < $nextReset)
			{
				if ($activityLevel > $raidsCompleted[$activityId])
				{
					$raidsCompleted[$activityId] = $activityLevel;
				}
			}
		}

		// arena completion status
		$arenasCompleted = [];
		foreach ($arenas as $arena)
		{
			$activityHash  = (string) $arena['activityDetails']['referenceId'];

			$completed = (bool) array_get($arena, 'values.completed.basic.value', false);
			$date = carbon($arena['period']);

			if ( ! array_key_exists($activityHash, $arenasCompleted))
			{
				$arenasCompleted[$activityHash] = false;
			}

			if ($completed && $date > $lastReset && $date < $nextReset)
			{
				$arenasCompleted[$activityHash] = $completed;
			}
		}

		// stats grouped by activity hash
		$statsArray = [];
		foreach ($stats as $k => $stat)
		{
			$activityHash = (string) $stat['activityHash'];
			$statsArray[$activityHash] = new StatisticsCollection($stat['values']);
		}

		// build ActivityCollection
		foreach ($activities['available'] as $activity)
		{
			$activityHash  = (string) $activity['activityHash'];
			$activityStats = array_get($statsArray, $activityHash);

			$activity   = new Activity($character, $activity, $activityStats);
			$activityId = sha1($activity->activityName);

			if ($activity->isCompleted && ($activity->isWeekly() || $activity->isDaily()))
			{
				$lastReset = ($activity->isWeekly() ? last_weekly() : last_daily());

				$activity->isCompleted = ($character->dateLastPlayed > $lastReset);
			}

			$this->put($activityHash, $activity);

			if ($activity->isRaid())
			{
				$activity->isCompleted = false;
				$activityLevelCompleted = array_get($raidsCompleted, $activityId);

				if ( ! $activityLevelCompleted)
				{
					continue;
				}

				if ($activity->activityLevel <= $activityLevelCompleted)
				{
					$activity->isCompleted = true;
				}
			}

			if ($activity->isArena())
			{
				$activity->isCompleted = array_get($arenasCompleted, $activityHash, false);
			}
		}
	}

	/**
	 * @return $this
	 */
	public function sortByLevel()
	{
		return $this->sortBy(function(Activity $activity)
		{
			$level = $activity->activityLevel;
			$name  = $activity->activityName;

			return $level.'.'.$name;
		});
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

	protected function gWeeklyRaids()
	{
		$items = [];

		foreach ($this as $k => $activity)
		{
			if ($activity->isRaid())
			{
				$items[$k] = $activity;
			}
		}

		return $items;
	}

	protected function gWeeklyArenas()
	{
		$items = [];

		foreach ($this->sortByLevel() as $k => $activity)
		{
			if ($activity->isArena())
			{
				$items[$k] = $activity;
			}
		}

		return $items;
	}
}

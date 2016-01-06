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

	/**
	 * @var \Destiny\Advisors\Activity
	 */
	public $dailyChapter;

	public function __construct(Character $character, array $activities, array $pves, array $stats)
	{
		$this->character = $character;
		$this->dateActivityStarted = carbon($activities['dateActivityStarted']);

		$lastReset = last_weekly();
		$nextReset = next_weekly();

		// raid, arena and nightfall completion status
		$raidsCompleted = [];
		$arenasCompleted = [];
		$activitiesCompleted = [];

		// need advisors to identify daily
		$this->dailyChapter = destiny()->advisors()->daily;

		foreach($pves as $pve)
		{
			$activityHash   = (string) $pve['activityDetails']['referenceId'];
			$activity       = manifest()->activity($activityHash);
			$activityId     = sha1($activity->activityName);
			$activityType   = $activity->activityType;
			$completed      = (bool) array_get($pve, 'values.completed.basic.value', false);
			$date           = carbon($pve['period']);

			if ($activityType->isRaid())
			{
				$activityLevel = $activity->activityLevel;

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

			if ($activityType->isArena())
			{
				if ( ! array_key_exists($activityHash, $arenasCompleted))
				{
					$arenasCompleted[$activityHash] = false;
				}

				if ($completed && $date > $lastReset && $date < $nextReset)
				{
					$arenasCompleted[$activityHash] = $completed;
				}
			}

			if ($activityType->isNightfall())
			{
				$nightfallHash = $activity->activityType->activityTypeHash;

				if ( ! array_key_exists($nightfallHash, $activitiesCompleted))
				{
					$activitiesCompleted[$nightfallHash] = false;
				}

				if ($completed && $date > $lastReset && $date < $nextReset)
				{
					$activitiesCompleted[$nightfallHash] = $completed;
				}
			}

			if ($activityHash == $this->dailyChapter->activityHash)
			{
				if ( ! array_key_exists($activityHash, $activitiesCompleted))
				{
					$activitiesCompleted[$activityHash] = false;
				}

				if ($completed && $date > last_daily() && $date < next_daily())
				{
					$activitiesCompleted[$activityHash] = $completed;
				}
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

			if ($activity->isCompleted && $activity->isWeekly())
			{
				$activity->isCompleted = ($character->dateLastPlayed > last_weekly());
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

			if ($activity->isNightfall())
			{
				$activity->isCompleted = array_get($activitiesCompleted, $activity->activityType->activityTypeHash, false);
			}

			if ($activityHash == $this->dailyChapter->activityHash)
			{
				$activity->isCompleted = array_get($activitiesCompleted, $activityHash, false);
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

	protected function gDailyAndNightfall()
	{
		$items = [];

		foreach($this as $k => $activity)
		{
			if ($activity->activityHash == $this->dailyChapter->activityHash || $activity->isNightfall())
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

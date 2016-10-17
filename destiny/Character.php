<?php namespace Destiny;

use Destiny\Character\ActivityCollection;
use Destiny\Character\Inventory;
use Destiny\Character\ProgressionCollection;

/**
 * @property string $membershipId
 * @property string $membershipType
 * @property string $characterId
 * @property array $levelProgression
 * @property string $emblemPath
 * @property string $emblemHash
 * @property string $backgroundPath
 * @property int $characterLevel
 * @property int $baseCharacterLevel
 * @property bool $isPrestigeLevel
 * @property float $percentToNextLevel
 * @property int $nextLightLevelAt
 * @property bool $isMaxed
 * @property int $genderType
 * @property int $classType
 * @property string $buildStatGroupHash
 * @property int $grimoireScore
 * @property array $peerView
 * @property array $customization
 * @property \Carbon\Carbon $dateLastPlayed
 * @property int $minutesPlayedThisSession
 * @property int $minutesPlayedTotal
 * @property int $powerLevel
 * @property string $raceHash
 * @property string $genderHash
 * @property string $classHash
 * @property string $currentActivityHash
 * @property string $lastCompletedStoryHash
 * @property array $stats
 *
 * @property int $hoursPlayedTotal
 * @property string $race
 * @property string $gender
 * @property string $raceGender
 * @property string $class
 * @property int $lightLevel
 *
 * @property \Destiny\Character\ActivityCollection $activities
 * @property \Destiny\Character\Activity[] $weeklyActivities
 * @property \Destiny\Character\Activity[] $weeklyStrikes
 * @property \Destiny\Character\Activity[] $weeklyRaids
 * @property boolean $private
 *
 * @property \Destiny\Character\Inventory $inventory
 * @property \Destiny\Character\ProgressionCollection $progression
 * @property \Destiny\Character\Statistics $statistics
 *
 * @property bool $playedAfterWeeklyReset
 * @property \Destiny\Account $account
 */
class Character extends Model
{
	const PRESTIGE_LEVEL = 20;
	const MAX_LEVEL = 40;

	/**
	 * @var array
	 */
	protected $lightLevels = [
		21 => 20,
		22 => 32,
		23 => 43,
		24 => 54,
		25 => 65,
		26 => 76,
		27 => 87,
		28 => 98,
		29 => 109,
		30 => 120,
		31 => 132,
		32 => 144,
		33 => 156,
		34 => 168,
		35 => 180,
		36 => 192,
		37 => 204,
		38 => 216,
		39 => 228,
		40 => 240,
	];

	/**
	 * @var \Destiny\Account
	 */
	protected $account;

	/**
	 * @var \Destiny\Character\ActivityCollection
	 */
	protected $activities;

	/**
	 * @var \Destiny\Character\Inventory
	 */
	protected $inventory;

	/**
	 * @var \Destiny\Character\ProgressionCollection
	 */
	protected $progression;

	public function __construct(Account $account, array $properties)
	{
		// merge characterBase into main array for easier access
		$properties = array_merge(array_except($properties, ['characterBase']), $properties['characterBase']);

		parent::__construct($properties);
		$this->account = $account;
	}

	protected function gAccount()
	{
		return $this->account;
	}

	protected function gDateLastPlayed($value)
	{
		return carbon($value);
	}

	protected function gPlayedAfterWeeklyReset()
	{
		return ($this->dateLastPlayed > last_weekly());
	}

	protected function gIsMaxed()
	{
		return $this->characterLevel == self::MAX_LEVEL;
	}

	protected function gNextLightLevelAt()
	{
		if ( ! $this->isPrestigeLevel)
		{
			return 0;
		}

		if ($this->isMaxed)
		{
			return $this->lightLevels[self::MAX_LEVEL];
		}

		return array_get($this->lightLevels, $this->characterLevel + 1, 0);
	}

	protected function gPercentLabel()
	{
		$progression = $this->progression->get($this->levelProgression['progressionHash']);
		return $progression->percentLabel;
	}

	protected function gLightLevel()
	{
		return $this->stats['STAT_LIGHT']['value'];
	}

	protected function gLightPercentLabel()
	{
		$lightValue = (array_key_exists('STAT_LIGHT', $this->stats) ? $this->stats['STAT_LIGHT']['value'] : 0);

		return sprintf("%d / %d",
			$lightValue,
			$this->nextLightLevelAt
		);
	}

	protected function gPercentToNextLevel()
	{
		$progression = $this->progression->get($this->levelProgression['progressionHash']);
		return $progression->percentToNextLevel;
	}

	protected function gClass()
	{
		$class = manifest()->characterClass($this->classHash);

		return $class->className;
	}

	protected function gRace()
	{
		$race = manifest()->race($this->raceHash);

		return $race->raceName;
	}

	protected function gGender()
	{
		$gender = manifest()->gender($this->genderHash);

		return $gender->genderName;
	}

	protected function gRaceGender()
	{
		return $this->race.' '.$this->gender;
	}

	protected function gHoursPlayedTotal()
	{
		return floor($this->minutesPlayedTotal / 60);
	}

	protected function gPrestige()
	{
		return $this->progression->get(ProgressionCollection::PRESTIGE);
	}

	protected function gWeeklyActivities()
	{
		return $this->activities->weekly;
	}

	protected function gDailyAndNightfall()
	{
		return $this->activities->dailyAndNightfall;
	}

	protected function gWeeklyStrikes()
	{
		return $this->activities->weeklyStrikes;
	}

	protected function gWeeklyRaids()
	{
		return $this->activities->weeklyRaids;
	}

	protected function gWeeklyArenas()
	{
		return $this->activities->weeklyArenas;
	}

	protected function gPrivate()
	{
		return count($this->activities) === 0;
	}

	protected function gStatistics()
	{
		return $this->account->statistics->character($this->characterId);
	}

	protected function gMinutesPlayedActive()
	{
		return $this->statistics->total->secondsPlayed->value / 60;
	}

	public function hasStats()
	{
		return $this->statistics->total->score->value > 0;
	}


	//
	// Getters
	//

	protected function gActivities()
	{
		return $this->activities;
	}

	protected function gInventory()
	{
		return $this->inventory;
	}

	protected function gProgression()
	{
		return $this->progression;
	}


	//
	// Setters
	//

	protected function sInventory(Inventory $inventory)
	{
		return $this->inventory = $inventory;
	}

	protected function sActivities(ActivityCollection $activities)
	{
		return $this->activities = $activities;
	}

	protected function sProgression(ProgressionCollection $progression)
	{
		return $this->progression = $progression;
	}
}

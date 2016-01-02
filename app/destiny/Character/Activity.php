<?php namespace Destiny\Character;

use Destiny\Character;
use Destiny\Model;
use Destiny\StatisticsCollection;

/**
 * @property string $activityHash
 * @property bool $isNew
 * @property bool $canLead
 * @property bool $canJoin
 * @property bool $isCompleted
 * @property bool $isVisible
 *
 * @property string $activityName
 * @property string $icon
 * @property string $identifier
 * @property int $activityLevel
 * @property int $timesCompleted
 *
 * @property \Destiny\Definitions\Activity $definition
 * @property \Destiny\Definitions\ActivityType $activityType
 * @property \Destiny\StatisticsCollection $stats
 */
class Activity extends Model
{
	protected static $customIcons = [
		'ARENA_CHALLENGE' => [
			32 => '/img/destiny_content/arena/32_challenge.v2.png',
			34 => '/img/destiny_content/arena/34_challenge.v2.png',
			35 => '/img/destiny_content/arena/35_challenge.v2.png',
		],
	];

	/**
	 * @var \Destiny\Character
	 */
	protected $character;

	/**
	 * @var \Destiny\StatisticsCollection
	 */
	protected $stats;

	public function __construct(Character $character, array $properties, StatisticsCollection $stats = null)
	{
		parent::__construct($properties);
		$this->character = $character;
		$this->stats = $stats ?: new StatisticsCollection;
	}

	protected function gDefinition()
	{
		return manifest()->activity($this->activityHash);
	}

	protected function gActivityHash($value)
	{
		return (string) $value;
	}

	protected function gActivityType()
	{
		return $this->definition->activityType;
	}

	protected function gActivityName()
	{
		return $this->definition->activityName;
	}

	protected function gActivityLevel()
	{
		return $this->definition->activityLevel;
	}

	protected function gIcon()
	{
		$type = $this->activityType->identifier;
		$tier = $this->activityLevel;

		return array_get(static::$customIcons, "$type.$tier", $this->definition->icon);
	}

	protected function gTimesCompleted()
	{
		return $this->stats->activityCompletions->value ?: 0;
	}

	public function isNightfall()
	{
		return $this->activityType->isNightfall();
	}

	public function isRaid()
	{
		return $this->activityType->isRaid();
	}

	public function isArena()
	{
		return $this->activityType->isArena();
	}

	public function isWeeklyHeroic()
	{
		return $this->activityType->isWeeklyHeroic();
	}

	public function isDaily()
	{
		return $this->activityType->isDaily();
	}

	public function isWeekly()
	{
		return $this->activityType->isWeekly();
	}
}

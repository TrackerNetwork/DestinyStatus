<?php namespace Destiny\Advisors;

use Destiny\Definitions\InventoryItem as ItemDefinition;

/**
 * @property int $value
 * @property string $quantity
 */
class Reward extends ItemDefinition
{
	const STRANGE_COIN     = '3037982556';
	const VANGUARD_MARKS   = '523605903';
	const VANGUARD_REP     = '3110575382';
	const CRYPTARCH_ENGRAM = '2421755581';

	protected $patches = [
		self::STRANGE_COIN   => [30 => 6,   32 => 9],
		self::VANGUARD_MARKS => [30 => 6,   32 => 10],
		self::VANGUARD_REP   => [30 => 250, 32 => 400],
	];

	/**
	 * @var \Destiny\Advisors\ActivityLevel
	 */
	protected $activityLevel;

	public function __construct(ActivityLevel $level, array $properties)
	{
		parent::__construct($properties);
		$this->extend(manifest()->inventoryItem($this->itemHash));
		$this->activityLevel = $level;
	}

	protected function gValue($value)
	{
		$hash = $this->itemHash;
		$level = $this->activityLevel->level;

		if ($this->activityLevel->definition->activityType->isWeekly())
		{
			return array_get($this->patches, "$hash.$level", $value);
		}

		return $value;
	}

	protected function gQuantity()
	{
		if ($this->value < 2) return '';

		return sprintf('&times; %s', $this->value);
	}
}

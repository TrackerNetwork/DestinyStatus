<?php namespace Destiny\Advisors;

use Destiny\Model;

/**
 * @property string $activityHash
 * @property string $iconPath
 * @property \Destiny\Advisors\ArenaRoundCollection $rounds
 * @property bool $bossFight
 * @property array $bossSkulls
 * @property array $activeRewardIndexes
 * @property bool $isCompleted
 *
 * @property string $activityName
 * @property string $bossName
 *
 * @property \Destiny\Definitions\Activity $activity
 */
class Arena extends Model
{
	protected $definition;
	protected $bossNames = [
		'2326253031' => 'Skolas',
	];

	public function __construct(array $properties)
	{
		parent::__construct($properties);
		$this->definition = manifest()->activity($this->activityHash);
		$this->rounds = $this->newCollection();

		foreach ($properties['rounds'] as $k => $round)
		{
			$round = new ArenaRound($this, $round);
			$round->roundNumber = $k + 1;

			$this->rounds->put($k, $round);
		}
	}

	protected function gActivity()
	{
		return $this->definition;
	}

	protected function gActivityName()
	{
		return $this->definition->activityName;
	}

	protected function gBossName()
	{
		return array_get($this->bossNames, $this->activityHash, 'Unknown');
	}

	protected function gBossSkulls()
	{
		$skulls = [];

		foreach ($this->properties['bossSkulls'] as $skull)
		{
			$skulls[] = manifest()->scriptedSkull($skull);
		}

		return $skulls;
	}
}

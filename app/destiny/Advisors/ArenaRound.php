<?php namespace Destiny\Advisors;

use Destiny\Model;

/**
 * @property string $enemyRaceHash
 * @property \Destiny\Definitions\ScriptedSkull[] $skulls
 * @property int $roundNumber
 *
 * @property \Destiny\Definitions\EnemyRace $enemy
 */
class ArenaRound extends Model
{
	protected $arena;

	public function __construct(Arena $arena, array $properties)
	{
		parent::__construct($properties);
		$this->arena = $arena;
	}

	protected function gEnemy()
	{
		return manifest()->enemyRace($this->enemyRaceHash);
	}

	protected function gSkulls(array $skulls)
	{
		$array = [];

		foreach ($skulls as $skullHash)
		{
			$array[] = manifest()->scriptedSkull($skullHash);
		}

		return $array;
	}
}

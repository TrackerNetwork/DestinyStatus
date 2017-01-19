<?php namespace Destiny\Character;

use Destiny\Collection;
use Destiny\Character;

/**
 * @method \Destiny\Character\Progression offsetGet($key)
 */
class ProgressionCollection extends Collection
{
	const PRESTIGE            = '2030054750';
	const WEEKLY_PVE          = '2033897742';
	const WEEKLY_PVP          = '2033897755';
	const GUNSMITH            = '2335631936';
	const CRYPTARCH           = '529303302';
	const IRON_BANNER         = '2161005788';
	const VANGUARD            = '3233510749';
	const CRUCIBLE            = '1357277120';
	const DEAD_ORBIT          = '2778795080';
	const NEW_MONARCHY        = '3871980777';
	const FUTURE_WAR_CULT     = '1424722124';
	const ERIS_MORN           = '174528503';
	const HOUSE_OF_JUDGMENT   = '3641985238';
	const QUEEN               = '807090922';
	const TOS_WINS            = '692939593';
	const TOS_LOSSES          = '2760041825';
	const SRL				  = '2763619072';
     
	public function __construct(Character $character, array $properties)
	{
		foreach ($properties['progressions'] as $properties)
		{
			$progression = new Progression($character, $properties);
			$this->put($progression->progressionHash, $progression);
		}
	}

	protected function gPrestige()
	{
		return $this->get(self::PRESTIGE);
	}

	protected function gWeeklyVanguard()
	{
		return $this->get(self::WEEKLY_PVE);
	}

	protected function gWeeklyCrucible()
	{
		return $this->get(self::WEEKLY_PVP);
	}

	protected function gCryptarch()
	{
		return $this->get(self::CRYPTARCH);
	}

	protected function gGunsmith()
	{
		return $this->get(self::GUNSMITH);
	}

	protected function gQueen()
	{
		return $this->get(self::QUEEN);
	}

	protected function gIronBanner()
	{
		return $this->get(self::IRON_BANNER);
	}

	protected function gVanguard()
	{
		return $this->get(self::VANGUARD);
	}

	protected function gCrucible()
	{
		return $this->get(self::CRUCIBLE);
	}

	protected function gDeadOrbit()
	{
		return $this->get(self::DEAD_ORBIT);
	}

	protected function gNewMonarchy()
	{
		return $this->get(self::NEW_MONARCHY);
	}

	protected function gFutureWarCult()
	{
		return $this->get(self::FUTURE_WAR_CULT);
	}

	protected function gErisMorn()
	{
		return $this->get(self::ERIS_MORN);
	}

	protected function gHouseOfJudgment()
	{
		return $this->get(self::HOUSE_OF_JUDGMENT);
	}

	protected function gTrialsWins()
	{
		return $this->get(self::TOS_WINS);
	}

	protected function gTrialsLosses()
	{
		return $this->get(self::TOS_LOSSES);
	}
    
	protected function gSrl()
	{
		return $this->get(self::SRL);
	}
}

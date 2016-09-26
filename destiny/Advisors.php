<?php namespace Destiny;

use Destiny\AdvisorsTwo\Activity;
use Destiny\AdvisorsTwo\Activity\ElderChallenge;
use Destiny\AdvisorsTwo\Activity\PrisonOfElders;
use Destiny\AdvisorsTwo\Activity\Trials;
use Destiny\AdvisorsTwo\Activity\ArmsDay;
use Destiny\AdvisorsTwo\Activity\WeeklyCrucible;
use Destiny\AdvisorsTwo\Activity\KingsFall;
use Destiny\AdvisorsTwo\Activity\VaultOfGlass;
use Destiny\AdvisorsTwo\Activity\Crota;
use Destiny\AdvisorsTwo\Activity\Nightfall;
use Destiny\AdvisorsTwo\Activity\HeroicStrike;
use Destiny\AdvisorsTwo\Activity\DailyChapter;
use Destiny\AdvisorsTwo\Activity\DailyCrucible;
use Destiny\AdvisorsTwo\Activity\PrisonOfEldersPlaylist;
use Destiny\AdvisorsTwo\Activity\IronBanner;
use Destiny\AdvisorsTwo\Activity\Xur;
use Destiny\AdvisorsTwo\Activity\Srl;
use Destiny\AdvisorsTwo\Activity\WrathOfTheMachine;

/**
 * @property AdvisorActivityCollection $activities
 * @property PrisonOfElders $prisonofelders
 * @property ElderChallenge $elderchallenge
 * @property Trials $trials
 * @property ArmsDay $armsday
 * @property WeeklyCrucible $weeklycrucible
 * @property KingsFall $kingsfall
 * @property VaultOfGlass $vaultofglass
 * @property Crota $crota
 * @property Nightfall $nightfall
 * @property HeroicStrike $heroicstrike
 * @property DailyChapter $dailychapter
 * @property DailyCrucible $dailycrucible
 * @property PrisonOfEldersPlaylist $prisonofeldersplaylist
 * @property IronBanner $ironbanner
 * @property Xur $xur
 * @property Srl $srl
 * @property WrathOfTheMachine $wrathofthemachine
 *
 * @property Activity[] $events
 * @property Activity[] $activeEvents
 */
class Advisors extends Model
{
	/**
	 * Advisors constructor.
	 * @param array $properties
	 */
	public function __construct(array $properties = [])
	{
		$properties['activities'] = new AdvisorActivityCollection($this, $properties['activities']);
		parent::__construct($properties);
	}

	private function getActivity($identifier)
	{
		return $this->activities->get($identifier);
	}

	protected function gEvents()
    {
        $events = ['trials', 'armsDay', 'ironBanner', 'xur', 'srl'];
        $return = [];

        foreach ($events as $event) {
            $return[] = $this->{$event};
        }

        return array_filter($return);
    }

    protected function gActiveEvents()
	{
		$events = $this->events;
		$return = [];
		foreach ($events as $event)
		{
			if ($event->status->active)
			{
				$return[] = $event;
			}
		}

		return $return;
	}

	public function hasBlockEvents()
	{
		$return = false;

		foreach ($this->activeEvents as $event)
		{
			if ($event instanceof Activity\EventInterface)
			{
				$return = true;
			}
		}

		return $return;
	}

	protected function gPrisonOfElders()
	{
		return $this->getActivity(PrisonOfElders::getIdentifier());
	}

	protected function gElderChallenge()
	{
		return $this->getActivity(ElderChallenge::getIdentifier());
	}

	protected function gTrials()
    {
        return $this->getActivity(Trials::getIdentifier());
    }

    protected function gArmsDay()
	{
		return $this->getActivity(ArmsDay::getIdentifier());
	}

	protected function gWeeklyCrucible()
	{
		return $this->getActivity(WeeklyCrucible::getIdentifier());
	}

	protected function gKingsFall()
	{
		return $this->getActivity(KingsFall::getIdentifier());
	}

	protected function gVaultOfGlass()
	{
		return $this->getActivity(VaultOfGlass::getIdentifier());
	}

	protected function gCrota()
	{
		return $this->getActivity(Crota::getIdentifier());
	}

	protected function gNightfall()
	{
		return $this->getActivity(Nightfall::getIdentifier());
	}

	protected function gHeroicStrike()
	{
		return $this->getActivity(HeroicStrike::getIdentifier());
	}

	protected function gDailyChapter()
	{
		return $this->getActivity(DailyChapter::getIdentifier());
	}

	protected function gDailyCrucible()
	{
		return $this->getActivity(DailyCrucible::getIdentifier());
	}

	protected function gPrisonOfEldersPlaylist()
	{
		return $this->getActivity(PrisonOfEldersPlaylist::getIdentifier());
	}

	protected function gIronBanner()
	{
		return $this->getActivity(IronBanner::getIdentifier());
	}

	protected function gXur()
	{
		return $this->getActivity(Xur::getIdentifier());
	}

	protected function gSrl()
	{
		return $this->getActivity(Srl::getIdentifier());
	}

    protected function gWrathOfTheMachine()
    {
        return $this->getActivity(WrathOfTheMachine::getIdentifier());
    }

	public function eventsExist()
	{
		$events = $this->events;
		foreach ($events as $event)
		{
			if ($event->status->active)
			{
				return true;
			}
		}

		return false;
	}
}

<?php namespace Destiny;

/**
 * @property \Destiny\Statistic $activitiesCleared
 * @property \Destiny\Statistic $activitiesEntered
 * @property \Destiny\Statistic $activitiesWon
 * @property \Destiny\Statistic $activityCompletions
 * @property \Destiny\Statistic $allParticipantsCount
 * @property \Destiny\Statistic $allParticipantsScore
 * @property \Destiny\Statistic $allParticipantsTimePlayed
 * @property \Destiny\Statistic $assists
 * @property \Destiny\Statistic $closeCalls
 * @property \Destiny\Statistic $bestSingleGameKills
 * @property \Destiny\Statistic $bestSingleGameScore
 * @property \Destiny\Statistic $deaths
 * @property \Destiny\Statistic $defensiveKills
 * @property \Destiny\Statistic $dominationKills
 * @property \Destiny\Statistic $fastestCompletion
 * @property \Destiny\Statistic $kills
 * @property \Destiny\Statistic $longestKillSpree
 * @property \Destiny\Statistic $longestSingleLife
 * @property \Destiny\Statistic $mostPrecisionKills
 * @property \Destiny\Statistic $objectivesCompleted
 * @property \Destiny\Statistic $offensiveKills
 * @property \Destiny\Statistic $orbsDropped
 * @property \Destiny\Statistic $orbsGathered
 * @property \Destiny\Statistic $precisionKills
 * @property \Destiny\Statistic $publicEventsCompleted
 * @property \Destiny\Statistic $publicEventsJoined
 * @property \Destiny\Statistic $relicsCaptured
 * @property \Destiny\Statistic $remainingTimeAfterQuitSeconds
 * @property \Destiny\Statistic $resurrectionsPerformed
 * @property \Destiny\Statistic $resurrectionsReceived
 * @property \Destiny\Statistic $score
 * @property \Destiny\Statistic $secondsPlayed
 * @property \Destiny\Statistic $suicides
 * @property \Destiny\Statistic $totalDeathDistance
 * @property \Destiny\Statistic $totalKillDistance
 * @property \Destiny\Statistic $totalActivityDurationSeconds
 * @property \Destiny\Statistic $teamScore
 * @property \Destiny\Statistic $weaponKillsSuper
 * @property \Destiny\Statistic $weaponKillsMelee
 * @property \Destiny\Statistic $weaponKillsGrenade
 * @property \Destiny\Statistic $weaponKillsAutoRifle
 * @property \Destiny\Statistic $weaponKillsFusionRifle
 * @property \Destiny\Statistic $weaponKillsHandCannon
 * @property \Destiny\Statistic $weaponKillsSideArm
 * @property \Destiny\Statistic $weaponKillsMachinegun
 * @property \Destiny\Statistic $weaponKillsPulseRifle
 * @property \Destiny\Statistic $weaponKillsRelic
 * @property \Destiny\Statistic $weaponKillsRocketLauncher
 * @property \Destiny\Statistic $weaponKillsSword
 * @property \Destiny\Statistic $weaponKillsScoutRifle
 * @property \Destiny\Statistic $weaponKillsShotgun
 * @property \Destiny\Statistic $weaponKillsSniper
 * @property \Destiny\Statistic $weaponKillsSubmachinegun
 * @property \Destiny\Statistic $zonesCaptured
 * @property \Destiny\Statistic $zonesNeutralized
 * @property \Destiny\Statistic $courtOfOryxWinsTier1
 * @property \Destiny\Statistic $courtOfOryxWinsTier2
 * @property \Destiny\Statistic $courtOfOryxWinsTier3
 * @property \Destiny\Statistic $weaponBestType
 */
class StatisticsCollection extends Collection
{
	public function __construct(array $items = [])
	{
		foreach ($items as $item)
		{
			$statistic = new Statistic($item);
			$this->put($statistic->statId, $statistic);
		}
	}

	/**
	 * @param string $key
	 *
	 * @return \Destiny\Statistic
	 */
	public function offsetGet($key)
	{
		return array_get($this->items, $key, new Statistic(['statId' => $key]));
	}

	public function __get($key)
	{
		return $this->offsetGet($key);
	}
}

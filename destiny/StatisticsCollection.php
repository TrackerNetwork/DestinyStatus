<?php

namespace Destiny;

use Destiny\Definitions\Statistic;

/**
 * @property \Destiny\Definitions\Statistic $activitiesCleared
 * @property \Destiny\Definitions\Statistic $weaponKillsSuper
 * @property \Destiny\Definitions\Statistic $activitiesEntered
 * @property \Destiny\Definitions\Statistic $weaponKillsMelee
 * @property \Destiny\Definitions\Statistic $weaponKillsGrenade
 * @property \Destiny\Definitions\Statistic $abilityKills
 * @property \Destiny\Definitions\Statistic $assists
 * @property \Destiny\Definitions\Statistic $totalDeathDistance
 * @property \Destiny\Definitions\Statistic $averageDeathDistance
 * @property \Destiny\Definitions\Statistic $totalKillDistance
 * @property \Destiny\Definitions\Statistic $kills
 * @property \Destiny\Definitions\Statistic $averageKillDistance
 * @property \Destiny\Definitions\Statistic $secondsPlayed
 * @property \Destiny\Definitions\Statistic $deaths
 * @property \Destiny\Definitions\Statistic $averageLifespan
 * @property \Destiny\Definitions\Statistic $bestSingleGameKills
 * @property \Destiny\Definitions\Statistic $killsDeathsRatio
 * @property \Destiny\Definitions\Statistic $killsDeathsAssists
 * @property \Destiny\Definitions\Statistic $objectivesCompleted
 * @property \Destiny\Definitions\Statistic $precisionKills
 * @property \Destiny\Definitions\Statistic $resurrectionsPerformed
 * @property \Destiny\Definitions\Statistic $resurrectionsReceived
 * @property \Destiny\Definitions\Statistic $suicides
 * @property \Destiny\Definitions\Statistic $weaponKillsAutoRifle
 * @property \Destiny\Definitions\Statistic $weaponKillsFusionRifle
 * @property \Destiny\Definitions\Statistic $weaponKillsHandCannon
 * @property \Destiny\Definitions\Statistic $weaponKillsMachinegun
 * @property \Destiny\Definitions\Statistic $weaponKillsPulseRifle
 * @property \Destiny\Definitions\Statistic $weaponKillsRocketLauncher
 * @property \Destiny\Definitions\Statistic $weaponKillsScoutRifle
 * @property \Destiny\Definitions\Statistic $weaponKillsShotgun
 * @property \Destiny\Definitions\Statistic $weaponKillsSniper
 * @property \Destiny\Definitions\Statistic $weaponKillsSubmachinegun
 * @property \Destiny\Definitions\Statistic $weaponKillsRelic
 * @property \Destiny\Definitions\Statistic $weaponKillsSideArm
 * @property \Destiny\Definitions\Statistic $weaponKillsSword
 * @property \Destiny\Definitions\Statistic $weaponKillsAbility
 * @property \Destiny\Definitions\Statistic $weaponBestType
 * @property \Destiny\Definitions\Statistic $allParticipantsCount
 * @property \Destiny\Definitions\Statistic $allParticipantsTimePlayed
 * @property \Destiny\Definitions\Statistic $longestKillSpree
 * @property \Destiny\Definitions\Statistic $longestSingleLife
 * @property \Destiny\Definitions\Statistic $mostPrecisionKills
 * @property \Destiny\Definitions\Statistic $orbsDropped
 * @property \Destiny\Definitions\Statistic $orbsGathered
 * @property \Destiny\Definitions\Statistic $publicEventsCompleted
 * @property \Destiny\Definitions\Statistic $remainingTimeAfterQuitSeconds
 * @property \Destiny\Definitions\Statistic $totalActivityDurationSeconds
 * @property \Destiny\Definitions\Statistic $fastestCompletionMs
 * @property \Destiny\Definitions\Statistic $longestKillDistance
 * @property \Destiny\Definitions\Statistic $highestCharacterLevel
 * @property \Destiny\Definitions\Statistic $highestLightLevel
 * @property \Destiny\Definitions\Statistic $activitiesWon
 * @property \Destiny\Definitions\Statistic $score
 * @property \Destiny\Definitions\Statistic $averageScorePerKill
 * @property \Destiny\Definitions\Statistic $averageScorePerLife
 * @property \Destiny\Definitions\Statistic $bestSingleGameScore
 * @property \Destiny\Definitions\Statistic $winLossRatio
 * @property \Destiny\Definitions\Statistic $allParticipantsScore
 * @property \Destiny\Definitions\Statistic $teamScore
 * @property \Destiny\Definitions\Statistic $combatRating
 */
class StatisticsCollection extends Collection
{
    /**
     * StatisticsCollection constructor.
     *
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        foreach ($items as $item) {
            $statistic = new Statistic($item);
            $this->put($statistic->statId, $statistic);
        }
    }

    /**
     * @param string $key
     *
     * @return \Destiny\Definitions\Statistic
     */
    public function offsetGet($key)
    {
        return array_get($this->items, $key, new Statistic(['statId' => $key]));
    }

    /**
     * @param string $key
     *
     * @return Statistic
     */
    public function __get($key)
    {
        return $this->offsetGet($key);
    }
}

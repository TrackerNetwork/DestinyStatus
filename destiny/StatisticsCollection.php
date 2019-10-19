<?php

namespace Destiny;

use Destiny\Definitions\Statistic;

/**
 * @property \Destiny\Definitions\Statistic $activitiesCleared
 * @property \Destiny\Definitions\Statistic $activitiesEntered
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
 * @property \Destiny\Definitions\Statistic $weaponKillsBeamRifle
 * @property \Destiny\Definitions\Statistic $weaponKillsBow
 * @property \Destiny\Definitions\Statistic $weaponKillsFusionRifle
 * @property \Destiny\Definitions\Statistic $weaponKillsHandCannon
 * @property \Destiny\Definitions\Statistic $weaponKillsTraceRifle
 * @property \Destiny\Definitions\Statistic $weaponKillsMachineGun
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
 * @property \Destiny\Definitions\Statistic $weaponKillsGrenade
 * @property \Destiny\Definitions\Statistic $weaponKillsGrenadeLauncher
 * @property \Destiny\Definitions\Statistic $weaponKillsSuper
 * @property \Destiny\Definitions\Statistic $weaponKillsMelee
 * @property \Destiny\Definitions\Statistic $weaponBestType
 * @property \Destiny\Definitions\Statistic $allParticipantsCount
 * @property \Destiny\Definitions\Statistic $allParticipantsScore
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
 * @property \Destiny\Definitions\Statistic $teamScore
 * @property \Destiny\Definitions\Statistic $combatRating
 * @property \Destiny\Definitions\Statistic $weaponPrecisionKillsAutoRifle
 * @property \Destiny\Definitions\Statistic $weaponPrecisionKillsBeamRifle
 * @property \Destiny\Definitions\Statistic $weaponPrecisionKillsBow
 * @property \Destiny\Definitions\Statistic $weaponPrecisionKillsFusionRifle
 * @property \Destiny\Definitions\Statistic $weaponPrecisionKillsGrenade
 * @property \Destiny\Definitions\Statistic $weaponPrecisionKillsGrenadeLauncher
 * @property \Destiny\Definitions\Statistic $weaponPrecisionKillsHandCannon
 * @property \Destiny\Definitions\Statistic $weaponPrecisionKillsTraceRifle
 * @property \Destiny\Definitions\Statistic $weaponPrecisionKillsMachineGun
 * @property \Destiny\Definitions\Statistic $weaponPrecisionKillsMelee
 * @property \Destiny\Definitions\Statistic $weaponPrecisionKillsPulseRifle
 * @property \Destiny\Definitions\Statistic $weaponPrecisionKillsRocketLauncher
 * @property \Destiny\Definitions\Statistic $weaponPrecisionKillsScoutRifle
 * @property \Destiny\Definitions\Statistic $weaponPrecisionKillsShotgun
 * @property \Destiny\Definitions\Statistic $weaponPrecisionKillsSniper
 * @property \Destiny\Definitions\Statistic $weaponPrecisionKillsSubmachinegun
 * @property \Destiny\Definitions\Statistic $weaponPrecisionKillsSuper
 * @property \Destiny\Definitions\Statistic $weaponPrecisionKillsRelic
 * @property \Destiny\Definitions\Statistic $weaponPrecisionKillsSideArm
 * @property \Destiny\Definitions\Statistic $weaponKillsPrecisionKillsAutoRifle
 * @property \Destiny\Definitions\Statistic $weaponKillsPrecisionKillsBeamRifle
 * @property \Destiny\Definitions\Statistic $weaponKillsPrecisionKillsBow
 * @property \Destiny\Definitions\Statistic $weaponKillsPrecisionKillsFusionRifle
 * @property \Destiny\Definitions\Statistic $weaponKillsPrecisionKillsGrenade
 * @property \Destiny\Definitions\Statistic $weaponKillsPrecisionKillsGrenadeLauncher
 * @property \Destiny\Definitions\Statistic $weaponKillsPrecisionKillsHandCannon
 * @property \Destiny\Definitions\Statistic $weaponKillsPrecisionKillsTraceRifle
 * @property \Destiny\Definitions\Statistic $weaponKillsPrecisionKillsMachineGun
 * @property \Destiny\Definitions\Statistic $weaponKillsPrecisionKillsMelee
 * @property \Destiny\Definitions\Statistic $weaponKillsPrecisionKillsPulseRifle
 * @property \Destiny\Definitions\Statistic $weaponKillsPrecisionKillsRocketLauncher
 * @property \Destiny\Definitions\Statistic $weaponKillsPrecisionKillsScoutRifle
 * @property \Destiny\Definitions\Statistic $weaponKillsPrecisionKillsShotgun
 * @property \Destiny\Definitions\Statistic $weaponKillsPrecisionKillsSniper
 * @property \Destiny\Definitions\Statistic $weaponKillsPrecisionKillsSubmachinegun
 * @property \Destiny\Definitions\Statistic $weaponKillsPrecisionKillsSuper
 * @property \Destiny\Definitions\Statistic $weaponKillsPrecisionKillsRelic
 * @property \Destiny\Definitions\Statistic $weaponKillsPrecisionKillsSideArm
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

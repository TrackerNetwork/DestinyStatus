<?php

namespace Destiny\Definitions\Components;

use Carbon\Carbon;
use Destiny\Activity\ActivityStatCollection;
use Destiny\Collection;
use Destiny\Definitions\Definition;
use Destiny\Definitions\Manifest\DestinyClass;
use Destiny\Definitions\Manifest\Gender;
use Destiny\Definitions\Manifest\Race;
use Destiny\Definitions\Manifest\Stat;
use Destiny\Definitions\Progression\Progression;
use Destiny\Definitions\Statistic;
use Destiny\Profile\Progression\FactionCollection;
use Destiny\Profile\Progression\MilestoneCollection;
use Destiny\Profile\Progression\ProgressionCollection;
use Destiny\Profile\StatCollection;
use Destiny\StatisticsCollection;

/**
 * Class Character.
 *
 * @property string $membershipId
 * @property int $membershipType
 * @property string $characterId
 * @property string $dateLastPlayed
 * @property int $minutesPlayedThisSession
 * @property int $minutesPlayedTotal
 * @property int $light
 * @property array $stats
 * @property string $raceHash
 * @property string $genderHash
 * @property string $classHash
 * @property int $raceType
 * @property int $classType
 * @property int $genderType
 * @property string $emblemPath
 * @property string $emblemBackgroundPath
 * @property string $emblemHash
 * @property array $levelProgression
 * @property int $baseCharacterLevel
 * @property float $percentToNextLevel
 * @property-read Progression $progression
 * @property-read DestinyClass $class
 * @property-read Race $race
 * @property-read Gender $gender
 * @property-read string $raceGender
 * @property-read StatCollection $combinedStats
 * @property-read \Destiny\Character\Inventory $inventory
 * @property-read ProgressionCollection $progressions
 * @property-read FactionCollection $factions
 * @property-read MilestoneCollection $milestones
 * @property-read StatisticsCollection $statsAll
 * @property-read StatisticsCollection $statsPvP
 * @property-read StatisticsCollection $statsPvE
 * @property-read ActivityStatCollection $activities
 * @property-read Carbon $lastPlayed
 * @property-read string $percentLabel
 * @property-read float $lightPercentToNextLevel
 * @property-read string $lightPercentLabel
 * @property-read int $minutesPlayedActive
 */
class Character extends Definition
{
    protected $appends = [
        'progression',
        'combinedStats',
    ];

    const MAX_LIGHT = 305;

    // activities
    const MILESTONE_NIGHTFALL = '2171429505';
    const MILESTONE_CHALLENGES = '2122634728';

    // clan
    const MILESTONE_WEEKLYCLAN = '4253138191';
    const MILESTONE_XPCLAN = '3603098564';

    // pvp
    const MILESTONE_CALLTOARMS = '202035466';
    const MILESTONE_TRIALS = '3551755444';

    // pve
    const MILESTONE_MEDITATE = '3245985898';

    // raids
    const MILESTONE_LEVITHIAN_27 = '3660836525';

    protected function gProgression()
    {
        return new Progression($this->properties['levelProgression']);
    }

    protected function gCombinedStats()
    {
        return new StatCollection($this->properties['stats']);
    }

    protected function gLastPlayed()
    {
        return carbon($this->dateLastPlayed);
    }

    protected function gMinutesPlayedActive()
    {
        /** @var Statistic $result */
        $stat = $this->statsAll->get('totalActivityDurationSeconds');

        if ($stat === null) {
            return 0;
        }

        return $stat->value / 60;
    }

    protected function gClass()
    {
        $class = manifest()->destinyClass($this->classHash);

        return $class->display->name;
    }

    protected function gRace()
    {
        $race = manifest()->race($this->raceHash);

        return $race->display->name;
    }

    protected function gGender()
    {
        $gender = manifest()->gender($this->genderHash);

        return $gender->display->name;
    }

    protected function gRaceGender()
    {
        return $this->race.' '.$this->gender;
    }

    protected function gPercentToNextLevel()
    {
        $fraction = $this->progression->level / $this->progression->levelCap;

        return $fraction * 100;
    }

    protected function gPercentLabel()
    {
        if ($this->progression->levelCap === $this->progression->level) {
            return 'MAX';
        }

        return $this->progression->level.'/'.$this->progression->levelCap;
    }

    protected function gLightPercentToNextLevel()
    {
        $fraction = $this->light / self::MAX_LIGHT;

        return $fraction * 100;
    }

    protected function gLightPercentLabel()
    {
        return sprintf('%d / %d', $this->light, self::MAX_LIGHT);
    }

    protected function gMilestoneActivities()
    {
        return $this->getMilestones([self::MILESTONE_NIGHTFALL, self::MILESTONE_CHALLENGES]);
    }

    protected function gMilestoneClan()
    {
        return $this->getMilestones([self::MILESTONE_XPCLAN, self::MILESTONE_WEEKLYCLAN]);
    }

    protected function gMilestonePve()
    {
        return $this->getMilestones([self::MILESTONE_MEDITATE]);
    }

    protected function gMilestonePvp()
    {
        return $this->getMilestones([self::MILESTONE_CALLTOARMS, self::MILESTONE_TRIALS]);
    }

    protected function gMilestoneRaids()
    {
        return $this->getMilestones([self::MILESTONE_LEVITHIAN_27]);
    }

    private function getMilestones(array $hashes) : array
    {
        /** @var Collection $originalMilestones */
        $originalMilestones = $this->getNonMutatedProperty('milestones');
        $milestones = [];

        if (empty($originalMilestones)) {
            return [];
        }

        foreach ($originalMilestones as $milestone) {
            if (in_array($milestone->milestoneHash, $hashes)) {
                $milestones[] = $milestone;
            }
        }

        return $milestones;
    }
}

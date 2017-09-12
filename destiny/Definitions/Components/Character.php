<?php

namespace Destiny\Definitions\Components;

use Carbon\Carbon;
use Destiny\Collection;
use Destiny\Definitions\Definition;
use Destiny\Definitions\Manifest\DestinyClass;
use Destiny\Definitions\Manifest\Gender;
use Destiny\Definitions\Manifest\Race;
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

    const MAX_LIGHT = 350;

    const MILESTONE_NIGHTFALL = '2171429505';
    const MILESTONE_STRIKES = '1142551194';
    const MILESTONE_WEEKLYCLAN = '4253138191';
    const MILESTONE_XPCLAN = '3603098564';
    const MILESTONE_PVP = '342166397';
    const MILESTONE_CALLTOARMS = '202035466';
    const MILESTONE_MEDITATE = '3245985898';

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
        return ($stat->value / 60);
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

    protected function gMilestones()
    {
        /** @var Collection $originalMilestones */
        $originalMilestones = $this->getNonMutatedProperty('milestones');
        $milestones = [];

        $milestones[] = $originalMilestones->get(self::MILESTONE_NIGHTFALL);
        $milestones[] = $originalMilestones->get(self::MILESTONE_STRIKES);
        $milestones[] = $originalMilestones->get(self::MILESTONE_PVP);
        $milestones[] = $originalMilestones->get(self::MILESTONE_WEEKLYCLAN);
        $milestones[] = $originalMilestones->get(self::MILESTONE_XPCLAN);
        $milestones[] = $originalMilestones->get(self::MILESTONE_CALLTOARMS);
        $milestones[] = $originalMilestones->get(self::MILESTONE_MEDITATE);

        return $milestones;
    }
}

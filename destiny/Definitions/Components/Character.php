<?php

namespace Destiny\Definitions\Components;

use Destiny\Definitions\Definition;
use Destiny\Definitions\Manifest\DestinyClass;
use Destiny\Definitions\Manifest\Gender;
use Destiny\Definitions\Manifest\Race;
use Destiny\Definitions\Progression\Progression;
use Destiny\Profile\CharacterEquipmentCollection;
use Destiny\Profile\StatCollection;

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
 */
class Character extends Definition
{
    protected $appends = [
        'progression',
        'combinedStats'
    ];

    protected function gProgression()
    {
        return new Progression($this->properties['levelProgression']);
    }

    protected function gCombinedStats()
    {
        return new StatCollection($this->properties['stats']);
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
}

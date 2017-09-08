<?php

namespace Destiny\Definitions\Components;

use Carbon\Carbon;
use Destiny\Definitions\Definition;
use Destiny\Definitions\Manifest\DestinyClass;
use Destiny\Definitions\Manifest\Gender;
use Destiny\Definitions\Manifest\Race;
use Destiny\Definitions\Progression\Progression;
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
 * @property-read Carbon $lastPlayed
 * @property-read float $percentToNextLevel
 * @property-read string $percentLabel
 * @property-read float $lightPercentToNextLevel
 * @property-read string $lightPercentLabel
 */
class Character extends Definition
{
    protected $appends = [
        'progression',
        'combinedStats',
    ];

    const MAX_LIGHT = 300;

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
}

<?php

namespace Destiny\Definitions\Components;

use Destiny\Definitions\Definition;
use Destiny\Definitions\Progression\Progression;

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
 */
class Character extends Definition
{
    protected $appends = [
        'progression'
    ];

    protected function gProgression()
    {
        return new Progression($this->properties['levelProgression']);
    }
}

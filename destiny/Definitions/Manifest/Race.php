<?php

namespace Destiny\Definitions\Manifest;

use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;

/**
 * Class Race.
 *
 * @property array $displayProperties
 * @property int $raceType
 * @property array $genderedRaceNames
 * @property string $hash
 * @property int $index
 * @property bool $redacted
 * @property DisplayProperties $displayProperties
 */
class Race extends Definition
{
    protected $appends = [
        'display',
    ];

    protected function gDisplay()
    {
        return new DisplayProperties($this->displayProperties);
    }
}

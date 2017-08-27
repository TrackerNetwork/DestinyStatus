<?php

namespace Destiny\Definitions\Manifest;

use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;

/**
 * Class Race.
 *
 * @property DisplayProperties $displayProperties
 * @property int $raceType
 * @property array $genderedRaceNames
 * @property string $hash
 * @property int $index
 * @property bool $redacted
 */
class Race extends Definition
{
    protected $appends = [
        'displayProperties',
    ];
}

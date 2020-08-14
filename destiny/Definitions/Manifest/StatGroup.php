<?php

namespace Destiny\Definitions\Manifest;

use Destiny\Definitions\Definition;

/**
 * Class StatGroup.
 *
 * @property int    $maximumValue
 * @property int    $uiPosition
 * @property array  $scaledStats  (Stat\Display)
 * @property array  $overrides    (Stat\Override)
 * @property string $hash
 * @property int    $index
 * @property bool   $redacted
 */
class StatGroup extends Definition
{
    const STAT_CHAR_AVERAGE = 0;
    const STAT_CHARACTER = 1;
    const STAT_ITEM = 2;

    protected $appends = [
        'displayProperties',
    ];
}

<?php

namespace Destiny\Definitions\Manifest;

use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;

/**
 * Class Stat.
 *
 * @property DisplayProperties $displayProperties
 * @property int $aggregationType
 * @property bool $hasComputedBlock
 * @property string $hash
 * @property int $index
 * @property bool $redacted
 */
class Stat extends Definition
{
    const STAT_CHAR_AVERAGE = 0;
    const STAT_CHARACTER = 1;
    const STAT_ITEM = 2;

    protected $appends = [
        'displayProperties',
    ];
}

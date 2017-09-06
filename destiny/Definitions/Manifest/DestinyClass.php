<?php

namespace Destiny\Definitions\Manifest;

use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;

/**
 * Class DestinyClass.
 *
 * @property int $classType
 * @property array $displayProperties
 * @property array $genderedClassNames
 * @property array $mentorVendorHash
 * @property string $hash
 * @property int $index
 * @property bool $redacted
 * @property DisplayProperties $display
 */
class DestinyClass extends Definition
{
    protected $appends = [
        'display',
    ];

    protected function gDisplay()
    {
        return new DisplayProperties($this->displayProperties);
    }
}

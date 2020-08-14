<?php

namespace Destiny\Definitions\Manifest;

use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;

/**
 * Class Faction.
 *
 * @property array             $displayProperties
 * @property string            $progressionHash
 * @property string            $hash
 * @property int               $index
 * @property bool              $redacted
 * @property DisplayProperties $display
 * @property-read Progression $progression
 */
class Faction extends Definition
{
    protected $appends = [
        'display',
    ];

    protected function gDisplay()
    {
        return new DisplayProperties($this->displayProperties);
    }

    protected function gProgression()
    {
        return manifest()->progression($this->progressionHash);
    }
}

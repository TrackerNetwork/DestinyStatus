<?php

namespace Destiny\Definitions\Manifest;

use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;

/**
 * Class Faction
 * @package Destiny\Definitions\Manifest
 * @property DisplayProperties $displayProperties
 * @property string $progressionHash
 * @property string $hash
 * @property int $index
 * @property bool $redacted
 * @property-read Progression $progression
 */
class Faction extends Definition
{
    protected $appends = [
        'displayProperties',
    ];

    public function gProgression()
    {
        return manifest()->progression($this->progressionHash);
    }
}
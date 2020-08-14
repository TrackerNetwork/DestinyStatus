<?php

namespace Destiny\Definitions\Manifest;

use Destiny\Definitions\Common\ProgressionDisplayProperties;
use Destiny\Definitions\Definition;

/**
 * Class Progression.
 *
 * @property array                        $displayProperties
 * @property int                          $scope
 * @property bool                         $repeatLastStep
 * @property string                       $source
 * @property array                        $steps             (@todo - https://bungie-net.github.io/multi/schema_Destiny-Definitions-DestinyProgressionStepDefinition.html#schema_Destiny-Definitions-DestinyProgressionStepDefinition)
 * @property bool                         $visible
 * @property string                       $factionHash       (@todo - https://bungie-net.github.io/multi/schema_Destiny-Definitions-DestinyFactionDefinition.html#schema_Destiny-Definitions-DestinyFactionDefinition)
 * @property string                       $hash
 * @property int                          $index
 * @property bool                         $redacted
 * @property ProgressionDisplayProperties $display
 */
class Progression extends Definition
{
    protected $appends = [
        'display',
    ];

    protected function gDisplay()
    {
        return new ProgressionDisplayProperties($this->displayProperties);
    }
}

<?php

namespace Destiny\Definitions\Manifest;

use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;

/**
 * Class Activity.
 *
 * @property array $displayProperties
 * @property string $releaseIcon
 * @property int $releaseTime (epoch)
 * @property int $activityLevel
 * @property int $activityLightLevel
 * @property string $destinationHash (Destination)
 * @property string $placeHash (Place)
 * @property string $activityTypeHash (ActivityType)
 * @property int $tier
 * @property string $pgcrImage
 * @property array $rewards (Reward)
 * @property array $modifiers (Modifier)
 * @property bool $isPlaylist
 * @property array $challenges (Objective)
 * @property array $optionalUnlockStrings
 * @property array $activityGraphList (ActivityGraph)
 * @property array $matchmaking (Activity/MatchmakingBlock)
 * @property array $guidedGame (Activity/GuidedBlock)
 * @property string $activityModeHash
 * @property bool $isPvP
 * @property string $hash
 * @property int $index
 * @property bool $redacted
 * @property-read DisplayProperties $display
 */
class Activity extends Definition
{
    protected $appends = [
        'display',
    ];

    protected function gDisplay()
    {
        return new DisplayProperties($this->displayProperties);
    }
}

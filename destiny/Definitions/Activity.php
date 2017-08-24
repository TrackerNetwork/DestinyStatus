<?php

namespace Destiny\Definitions;

use Destiny\Definitions\Common\DisplayProperties;

/**
 * Class Activity
 * @package Destiny\Definitions
 * @property DisplayProperties $displayProperties
 * @property string $releaseIcon
 * @property int $releaseTime
 * @property int $activityLevel
 * @property int $activityLightLevel
 * @property string $destinationHash (Destination)
 * @property string $placeHash (Place)
 * @property string $activityTypeHash (ActivityType)
 * @property int $tier
 * @property string $pgcrImage
 * @property array $rewards (@todo - Destiny.Definitions.DestinyActivityRewardDefinition)
 * @property array $modifiers (@todo - Destiny.Definitions.DestinyActivityModifierReferenceDefinition)
 * @property bool $isPlaylist
 * @property array $challenges (@todo - Destiny.Definitions.DestinyActivityChallengeDefinition)
 * @property array $optionalUnlockStrings (@todo - Destiny.Definitions.DestinyActivityUnlockStringDefinition)
 * @property array $activityGraphList (GraphListEntry)
 * @property array $matchmaking (MatchmakingBlock)
 * @property array $guidedGame (GuidedBlock)
 * @property string $activityModeHash
 * @property bool $isPvP
 * @property string $hash
 * @property int $index
 * @property bool $redacted
 */
class Activity extends Definition
{
    protected $appends = [
        'displayProperties',
        'destination',
        'place',
        'activityType'
    ];
}
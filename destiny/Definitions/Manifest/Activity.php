<?php

namespace Destiny\Definitions\Manifest;

use App\Enums\Difficulty;
use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;

/**
 * Class Activity.
 *
 * @property array  $displayProperties
 * @property string $releaseIcon
 * @property int    $releaseTime           (epoch)
 * @property int    $activityLevel
 * @property int    $activityLightLevel
 * @property string $destinationHash       (Destination)
 * @property string $placeHash             (Place)
 * @property string $activityTypeHash      (ActivityType)
 * @property int    $tier
 * @property string $pgcrImage
 * @property array  $rewards               (Reward)
 * @property array  $modifiers             (Modifier)
 * @property bool   $isPlaylist
 * @property array  $challenges            (Objective)
 * @property array  $optionalUnlockStrings
 * @property array  $activityGraphList     (ActivityGraph)
 * @property array  $matchmaking           (Activity/MatchmakingBlock)
 * @property array  $guidedGame            (Activity/GuidedBlock)
 * @property string $activityModeHash
 * @property bool   $isPvP
 * @property string $hash
 * @property int    $index
 * @property bool   $redacted
 * @property-read DisplayProperties $display
 * @property-read Destination $destination
 * @property-read Place $place
 * @property-read ActivityType $activityType
 * @property-read ActivityMode $activityMode
 * @property-read string $humanMode
 */
class Activity extends Definition
{
    const NIGHTFALL_TYPE_HASH = '575572995';

    protected $appends = [
        'display',
    ];

    public function isNightfall()
    {
        return $this->activityTypeHash === self::NIGHTFALL_TYPE_HASH;
    }

    protected function gDisplay()
    {
        return new DisplayProperties($this->displayProperties);
    }

    protected function gDestination()
    {
        return app('destiny.manifest')->destination($this->destinationHash);
    }

    protected function gPlace()
    {
        return app('destiny.manifest')->place($this->placeHash);
    }

    protected function gActivityType()
    {
        return app('destiny.manifest')->activityType($this->activityTypeHash);
    }

    protected function gActivityMode()
    {
        return app('destiny.manifest')->activityMode($this->activityModeHash);
    }

    protected function gHumanMode()
    {
        switch ($this->tier) {
            case Difficulty::TRIVIAL:
                return 'Normal';

            case Difficulty::NORMAL:
                return 'Prestige';
            default:
                return 'Tier: '.$this->tier;
        }
    }
}

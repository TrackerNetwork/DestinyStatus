<?php

namespace Destiny\Definitions\Progression;

use Destiny\Definitions\Definition;

/**
 * Class Faction.
 *
 * @property string $factionHash
 * @property string $progressionHash
 * @property int $dailyProgress
 * @property int $dailyLimit
 * @property int $weeklyProgress
 * @property int $weeklyLimit
 * @property int $currentProgress
 * @property int $level
 * @property int $levelCap
 * @property int $stepIndex
 * @property int $progressToNextLevel
 * @property int $nextLevelAt
 */
class Faction extends Definition
{
    protected $appends = [
    ];
}

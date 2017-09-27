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
 * @property-read \Destiny\Definitions\Manifest\Faction $faction
 * @property-read \Destiny\Definitions\Manifest\Progression $progression
 * @property-read string $percentToNextLevel
 * @property-read string $percentLabel
 * @property-read string $description
 */
class Faction extends Definition
{
    protected $appends = [
        'faction',
        'progression',
    ];

    protected function gFaction()
    {
        return manifest()->faction((string) $this->factionHash);
    }

    protected function gProgression()
    {
        return manifest()->progression((string) $this->progressionHash);
    }

    protected function gName()
    {
        return $this->faction->display->name;
    }

    protected function gIcon()
    {
        return $this->faction->display->icon;
    }

    protected function gDescription()
    {
        return $this->faction->display->description;
    }

    protected function gPercentToNextLevel()
    {
        return ($this->progressToNextLevel / $this->nextLevelAt) * 100;
    }

    protected function gPercentLabel()
    {
        return $this->progressToNextLevel.'/'.$this->nextLevelAt;
    }
}

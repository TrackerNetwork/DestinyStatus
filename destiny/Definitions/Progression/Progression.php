<?php

namespace Destiny\Definitions\Progression;

use Destiny\Definitions\Definition;

/**
 * Class Progression.
 *
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
 * @property-read \Destiny\Definitions\Manifest\Progression $definition
 * @property-read string $icon
 * @property-read string $name
 * @property-read string $description
 * @property-read string $percentLabel
 * @property-read float $percentToNextLevel
 */
class Progression extends Definition
{
    protected $appends = [
        'definition',
    ];

    protected function gDefinition()
    {
        return manifest()->progression($this->progressionHash);
    }

    protected function gIcon()
    {
        return $this->definition->display->icon;
    }

    protected function gName()
    {
        return $this->definition->display->name;
    }

    protected function gDescription()
    {
        return $this->definition->display->description;
    }

    protected function gPercentToNextLevel()
    {
        return ($this->progressToNextLevel / $this->nextLevelAt) * 100;
    }

    protected function gPercentLabel()
    {
        return n($this->progressToNextLevel).'/'.n($this->nextLevelAt);
    }
}

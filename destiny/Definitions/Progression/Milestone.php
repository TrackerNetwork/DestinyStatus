<?php

namespace Destiny\Definitions\Progression;

use Destiny\Definitions\Definition;
use Destiny\Profile\Progression\QuestCollection;

/**
 * Class Milestone.
 *
 * @property string $milestoneHash
 * @property array $availableQuests
 * @property array $values
 * @property array $vendorHashes
 * @property array $rewards
 * @property string $startDate
 * @property string $endDate
 * @property \Destiny\Definitions\Manifest\Milestone $definition
 * @property QuestCollection $quests
 */
class Milestone extends Definition
{
    protected $appends = [
        'definition',
    ];

    protected function gDefinition()
    {
        return manifest()->milestone((string) $this->milestoneHash);
    }

    protected function gName()
    {
        return $this->definition->display->name;
    }

    protected function gIcon()
    {
        return $this->definition->display->icon;
    }

    protected function gQuests()
    {
        return new QuestCollection($this->availableQuests ?? []);
    }

    protected function gIsCompleted()
    {
        $quest = $this->getLastQuest();

        if (empty($quest)) {
            return false;
        }

        return $quest->completed;
    }

    protected function gActivityLevel()
    {
        $quest = $this->getLastQuest();

        if (empty($quest)) {
            return;
        }

        return $quest->activityLevel;
    }

    private function getLastQuest()
    {
        return $this->quests->last();
    }
}

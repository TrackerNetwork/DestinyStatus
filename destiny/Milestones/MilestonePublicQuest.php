<?php

declare(strict_types=1);

namespace Destiny\Milestones;

use Destiny\Definitions\Manifest\Milestone;
use Destiny\Model;

/**
 * Class MilestonePublicQuest
 * @package Destiny\Milestones
 * @property string $questItemHash
 * @property array $activity
 * @property array $challenges
 * @property-read Milestone $questItem
 * @property-read MilestoneActivity $milestoneActivity
 */
class MilestonePublicQuest extends Model
{
    protected $appends = [
        'questItem',
    ];

    protected function gQuestItem()
    {
        return manifest()->milestone((string) $this->questItemHash);
    }

    protected function gMilestoneActivity()
    {
        if (!empty($this->activity)) {
            return new MilestoneActivity($this->activity);
        }
    }
}

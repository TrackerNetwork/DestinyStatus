<?php

declare(strict_types=1);

namespace Destiny\Milestones;

use Destiny\Activity\ChallengeCollection;
use Destiny\Definitions\Manifest\InventoryItem;
use Destiny\Model;

/**
 * Class MilestonePublicQuest.
 *
 * @property string $questItemHash
 * @property array  $activity
 * @property array  $challenges
 * @property-read InventoryItem $questItem
 * @property-read MilestoneActivity $milestoneActivity
 * @property-read ChallengeCollection $milestoneChallenges
 */
class MilestonePublicQuest extends Model
{
    protected $appends = [
        'questItem',
    ];

    protected function gQuestItem()
    {
        return manifest()->inventoryItem((string) $this->questItemHash);
    }

    protected function gMilestoneActivity()
    {
        if (empty($this->activity)) {
            return;
        }

        return new MilestoneActivity($this->activity);
    }

    protected function gMilestoneChallenges()
    {
        return new ChallengeCollection($this->challenges ?? []);
    }
}

<?php

namespace Destiny\Definitions\Milestone;

use Destiny\Definitions\Definition;
use Destiny\Definitions\Manifest\Milestone;
use Destiny\Milestones\RewardEntryCollection;

/**
 * Class RewardCategory.
 *
 * @property string $rewardCategoryHash
 * @property array $entries
 * @property Milestone $milestone
 * @property-read RewardEntryCollection $rewards
 */
class RewardCategory extends Definition
{
    protected $appends = [
    ];

    protected function gMilestone()
    {
        return manifest()->milestone($this->rewardCategoryHash);
    }

    protected function gRewards()
    {
        return new RewardEntryCollection($this->entries);
    }
}

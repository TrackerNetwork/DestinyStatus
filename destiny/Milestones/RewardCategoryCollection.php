<?php

declare(strict_types=1);

namespace Destiny\Milestones;

use Destiny\Definitions\Manifest\Milestone;
use Destiny\Definitions\Milestone\RewardCategory;
use Illuminate\Support\Collection;

/**
 * @method RewardCategory offsetGet($key)
 */
class RewardCategoryCollection extends Collection
{
    /**
     * RewardCategoryCollection constructor.
     *
     * @param array $items
     */
    public function __construct(Milestone $milestone, array $items)
    {
        $rewards = [];
        foreach ($items as $item) {
            $rewards[$item['rewardCategoryHash']] = new RewardCategory($milestone, $item);
        }

        parent::__construct($rewards);
    }
}

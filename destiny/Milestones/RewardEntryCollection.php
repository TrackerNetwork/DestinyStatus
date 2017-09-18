<?php

declare(strict_types=1);

namespace Destiny\Milestones;

use Destiny\Definitions\Milestone\RewardEntry;
use Illuminate\Support\Collection;

/**
 * @method RewardEntry offsetGet($key)
 */
class RewardEntryCollection extends Collection
{
    /**
     * RewardEntryCollection constructor.
     *
     * @param array $items
     */
    public function __construct(array $items)
    {
        $rewards = [];
        foreach ($items as $item) {
            $rewards[$item['rewardEntryHash']] = new RewardEntry($item);
        }

        parent::__construct($rewards);
    }
}

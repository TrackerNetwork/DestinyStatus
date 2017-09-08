<?php

declare(strict_types=1);

namespace Destiny\Milestones;

use Illuminate\Support\Collection;
use Destiny\Definitions\PublicMilestone;

/**
 * @method PublicMilestone offsetGet($key)
 */
class MilestoneCollection extends Collection
{
    /**
     * MilestoneCollection constructor.
     * @param array $items
     */
    public function __construct(array $items)
    {
        $milestones = [];
        foreach ($items as $item) {
            $milestones[$item['milestoneHash']] = new PublicMilestone($item);
        }

        parent::__construct($milestones);
    }
}

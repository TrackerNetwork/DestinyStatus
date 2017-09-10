<?php

declare(strict_types=1);

namespace Destiny\Activity;

use Destiny\Milestones\MilestoneChallenge;
use Illuminate\Support\Collection;

/**
 * @method MilestoneChallenge offsetGet($key)
 */
class ChallengeCollection extends Collection
{
    /**
     * MilestoneCollection constructor.
     *
     * @param array $items
     */
    public function __construct(array $items)
    {
        $challenges = [];
        foreach ($items as $item) {
            $challenges[$item['objectiveHash']] = new MilestoneChallenge($item);
        }

        parent::__construct($challenges);
    }
}

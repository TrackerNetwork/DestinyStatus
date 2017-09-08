<?php

declare(strict_types=1);

namespace Destiny\Milestones;

use Illuminate\Support\Collection;

/**
 * @method MilestonePublicQuest offsetGet($key)
 */
class PublicQuestCollection extends Collection
{
    /**
     * MilestoneCollection constructor.
     *
     * @param array $items
     */
    public function __construct(array $items)
    {
        $quests = [];
        foreach ($items as $item) {
            $quests[$item['questItemHash']] = new MilestonePublicQuest($item);
        }

        parent::__construct($quests);
    }
}

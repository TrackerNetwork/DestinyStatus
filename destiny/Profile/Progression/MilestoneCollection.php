<?php

declare(strict_types=1);

namespace Destiny\Profile\Progression;

use Destiny\Collection;
use Destiny\Definitions\Progression\Milestone;

/**
 * Class MilestoneCollection.
 */
class MilestoneCollection extends Collection
{
    public function __construct(array $properties)
    {
        $milestones = [];

        foreach ($properties as $milestoneHash => $milestone) {
            $milestones[$milestoneHash] = new Milestone($milestone);
        }

        parent::__construct($milestones);
    }
}

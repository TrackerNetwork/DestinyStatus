<?php

namespace Destiny\Definitions;

use Carbon\Carbon;

/**
 * Class PublicMilestone.
 *
 * @property string $milestoneHash
 * @property array $availableQuests
 * @property array $vendorHashes
 * @property Carbon $startDate
 * @property Carbon $endDate
 */
class PublicMilestone extends Definition
{
    protected $appends = [
    ];

    protected function gStartDate()
    {
        return carbon($this->startDate);
    }

    protected function gEndDate()
    {
        return carbon($this->endDate);
    }
}

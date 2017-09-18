<?php

namespace Destiny\Definitions\Milestone;

use Destiny\Definitions\Definition;
use Destiny\Definitions\Manifest\ActivityType;

/**
 * Class RewardEntry.
 *
 * @property string $rewardEntryHash
 * @property bool $earned
 * @property bool $redeemed
 * @property ActivityType $definition
 */
class RewardEntry extends Definition
{
    protected $appends = [
        'definition',
    ];

    protected function gDefinition()
    {
        return manifest()->activityType((string) $this->rewardEntryHash);
    }
}

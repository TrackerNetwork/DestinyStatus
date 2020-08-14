<?php

namespace Destiny\Definitions\Milestone;

use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;
use Destiny\Definitions\Item\ItemCollection;

/**
 * Class RewardEntry.
 *
 * @property string $rewardEntryHash
 * @property string $rewardEntryIdentifier
 * @property array  $items
 * @property string $vendorHash
 * @property array  $displayProperties
 * @property int    $order
 * @property string $earnedUnlockHash
 * @property string $redeemedUnlockHash
 * @property bool   $earned
 * @property bool   $redeemed
 * @property-read string $icon
 * @property-read string $name
 * @property-read bool $isCompleted
 * @property-read ItemCollection $rewards
 */
class RewardEntry extends Definition
{
    protected $appends = [
        'display',
    ];

    protected function gDisplay()
    {
        return new DisplayProperties($this->displayProperties);
    }

    protected function gIcon()
    {
        return $this->display->icon;
    }

    protected function gName()
    {
        return $this->display->name;
    }

    protected function gIsCompleted()
    {
        return $this->earned;
    }

    protected function gVendor()
    {
        return manifest()->vendor($this->vendorHash);
    }

    protected function gRewards()
    {
        return new ItemCollection($this->items);
    }
}

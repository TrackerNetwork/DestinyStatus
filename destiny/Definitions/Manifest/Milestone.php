<?php

namespace Destiny\Definitions\Manifest;

use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;
use Illuminate\Support\Arr;

/**
 * Class Milestone.
 *
 * @property array  $displayProperties
 * @property string $image
 * @property int    $milestoneType       (DestinyMilestoneType)
 * @property bool   $recruitable
 * @property string $friendlyName
 * @property bool   $showInExplorer
 * @property bool   $hasPredictableDates
 * @property array  $quests              (@todo - https://bungie-net.github.io/multi/schema_Destiny-Definitions-Milestones-DestinyMilestoneQuestDefinition.html#schema_Destiny-Definitions-Milestones-DestinyMilestoneQuestDefinition)
 * @property array  $rewards             (@todo - https://bungie-net.github.io/multi/schema_Destiny-Definitions-Milestones-DestinyMilestoneRewardCategoryDefinition.html#schema_Destiny-Definitions-Milestones-DestinyMilestoneRewardCategoryDefinition)
 * @property array  $vendors             (@todo - https://bungie-net.github.io/multi/schema_Destiny-Definitions-Milestones-DestinyMilestoneVendorDefinition.html#schema_Destiny-Definitions-Milestones-DestinyMilestoneVendorDefinition)
 * @property array  $values              (Value)
 * @property bool   $isInGameMilestone
 * @property string $hash
 * @property int    $index
 * @property bool   $redacted
 * @property-read DisplayProperties $display
 * @property-read string $name
 * @property-read string $icon
 */
class Milestone extends Definition
{
    protected $appends = [
        'display',
    ];

    public function getRewardEntry(string $category, string $entry)
    {
        return Arr::get($this->properties, 'rewards.'.$category.'.rewardEntries.'.$entry, []);
    }

    public function addRewardEntry(string $category, string $entry, array $data)
    {
        $this->properties['rewards'][$category]['rewardEntries'][$entry]['earned'] = $data['earned'] ?? false;
        $this->properties['rewards'][$category]['rewardEntries'][$entry]['redeemed'] = $data['redeemed'] ?? false;
    }

    protected function gDisplay()
    {
        return new DisplayProperties($this->displayProperties);
    }

    protected function gName()
    {
        return $this->display->name;
    }

    protected function gIcon()
    {
        return $this->display->icon;
    }
}

<?php

namespace Destiny\Definitions\Manifest;

use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;

/**
 * Class Milestone.
 *
 * @property array $displayProperties
 * @property string $image
 * @property int $milestoneType (DestinyMilestoneType)
 * @property bool $recruitable
 * @property string $friendlyName
 * @property bool $showInExplorer
 * @property bool $hasPredictableDates
 * @property array $quests (@todo - https://bungie-net.github.io/multi/schema_Destiny-Definitions-Milestones-DestinyMilestoneQuestDefinition.html#schema_Destiny-Definitions-Milestones-DestinyMilestoneQuestDefinition)
 * @property array $rewards (@todo - https://bungie-net.github.io/multi/schema_Destiny-Definitions-Milestones-DestinyMilestoneRewardCategoryDefinition.html#schema_Destiny-Definitions-Milestones-DestinyMilestoneRewardCategoryDefinition)
 * @property array $vendors (@todo - https://bungie-net.github.io/multi/schema_Destiny-Definitions-Milestones-DestinyMilestoneVendorDefinition.html#schema_Destiny-Definitions-Milestones-DestinyMilestoneVendorDefinition)
 * @property array $values (Value)
 * @property bool $isInGameMilestone
 * @property string $hash
 * @property int $index
 * @property bool $redacted
 * @property-read DisplayProperties $display
 */
class Milestone extends Definition
{
    protected $appends = [
        'display',
    ];

    protected function gDisplay()
    {
        return new DisplayProperties($this->displayProperties);
    }
}

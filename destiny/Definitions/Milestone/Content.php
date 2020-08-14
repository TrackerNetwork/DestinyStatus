<?php

namespace Destiny\Definitions\Milestone;

use Destiny\Definitions\Definition;

/**
 * Class Content.
 *
 * @property string $about
 * @property string $status
 * @property array  $tips
 * @property array  $itemCategories (@todo - https://bungie-net.github.io/multi/schema_Destiny-Milestones-DestinyMilestoneContentItemCategory.html#schema_Destiny-Milestones-DestinyMilestoneContentItemCategory)
 */
class Content extends Definition
{
    protected $appends = [
    ];
}

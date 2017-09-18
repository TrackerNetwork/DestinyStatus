<?php

namespace Destiny\Definitions\Milestone;

use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;
use Destiny\Definitions\Manifest\Milestone;
use Destiny\Milestones\RewardEntryCollection;

/**
 * Class RewardCategory.
 *
 * @property string $categoryHash
 * @property string $rewardCategoryHash
 * @property string $categoryIdentifier
 * @property array $displayProperties
 * @property array $rewardEntries
 * @property int $order
 * @property array $entries
 * @property Milestone $definition
 * @property-read RewardEntryCollection $rewards
 * @property-read DisplayProperties $display
 */
class RewardCategory extends Definition
{
    public function __construct(Milestone $definition = null, array $properties)
    {
        foreach($properties['entries'] as $entry) {
            $definitionEntry = $definition->getRewardEntry($properties['rewardCategoryHash'], $entry['rewardEntryHash']);

            if (count($definitionEntry) > 0) {
                $definition->addRewardEntry($properties['rewardCategoryHash'], $entry['rewardEntryHash'], $entry);
            }
        }

        $properties['rewards'] = $definition['rewards'][$properties['rewardCategoryHash']];
        parent::__construct(array_merge($definition->toArray(), $properties));
    }

    protected function gDisplay()
    {
        return new DisplayProperties($this->displayProperties);
    }

    protected function gRewards()
    {
        return new RewardEntryCollection($this->getNonMutatedProperty('rewards')['rewardEntries']);
    }
}

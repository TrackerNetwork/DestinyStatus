<?php

namespace Destiny\AdvisorsTwo\Activity;

use Destiny\Advisors;
use Destiny\AdvisorsTwo\Activity;
use Destiny\AdvisorsTwo\ActivityTier;
use Destiny\AdvisorsTwo\Collections\ActivityTierCollection;
use Destiny\Definitions\InventoryItem;
use Destiny\Definitions\SkullModifier;

/**
 * @property string $progressionHash
 * @property ActivityTier $activityTier
 * @property InventoryItem[] $bounties
 * @property \Destiny\Definitions\Activity $definition
 * @property SkullModifier[] $skulls
 */
class HeroicStrike extends Activity implements ActivityInterface
{
    public function __construct(array $items, array $properties)
    {
        $properties['activityTier'] = (new ActivityTierCollection($this, $properties['activityTiers']))->first();

        if (isset($properties['bountyHashes'])) {
            $bounties = [];
            foreach ($properties['bountyHashes'] as $bountyHash) {
                $bounties[] = manifest()->inventoryItem($bountyHash);
            }

            $properties['bounties'] = $bounties;
        }

        if (isset($properties['activityTiers'][0]['activityHash'])) {
            $properties['definition'] = manifest()->activity($properties['activityTiers'][0]['activityHash']);
        }

        if (isset($properties['extended']['skullCategories'])) {
            $skulls = [];
            foreach ($properties['extended']['skullCategories'] as $skullCategory) {
                foreach ($skullCategory['skulls'] as $skull) {
                    $skull = new SkullModifier($skull);
                    $skull->isModifier = $skullCategory['title'] === 'Modifiers';
                    $skulls[] = $skull;
                }
            }
            $properties['skulls'] = $skulls;
        }

        parent::__construct($properties);
    }

    protected function gDestination()
    {
        return manifest()->destination($this->display->destinationHash);
    }

    protected function gActivity()
    {
        return $this->activityTier;
    }

    /**
     * @return string
     */
    public static function getIdentifier()
    {
        return 'heroicstrike';
    }
}

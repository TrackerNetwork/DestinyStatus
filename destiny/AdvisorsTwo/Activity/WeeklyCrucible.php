<?php

namespace Destiny\AdvisorsTwo\Activity;

use Destiny\AdvisorsTwo\Activity;
use Destiny\AdvisorsTwo\ActivityTier;
use Destiny\AdvisorsTwo\Collections\ActivityTierCollection;
use Destiny\Definitions\InventoryItem;

/**
 * @property string $progressionHash
 * @property ActivityTier $activityTier
 * @property InventoryItem[] $bounties
 * @property \Destiny\Definitions\Activity $definition
 */
class WeeklyCrucible extends Activity implements ActivityInterface
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
        return 'weeklycrucible';
    }

    public function isEventCancelled()
    {
        return false;
    }
}

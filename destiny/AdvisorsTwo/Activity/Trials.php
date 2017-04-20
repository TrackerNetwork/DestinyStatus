<?php

namespace Destiny\AdvisorsTwo\Activity;

use Destiny\Advisors;
use Destiny\AdvisorsTwo\Activity;
use Destiny\Definitions\InventoryItem;

/**
 * @property string $progressionHash
 * @property InventoryItem[] $bounties
 * @property InventoryItem[][] $winRewards
 */
class Trials extends Activity implements ActivityInterface, EventInterface
{
    public function __construct(array $items, array $properties)
    {
        $bounties = [];
        foreach ($properties['bountyHashes'] as $bountyHash) {
            $bounties[] = manifest()->inventoryItem($bountyHash);
        }

        $properties['bounties'] = $bounties;

        $winDetails = [];
        if (isset($properties['extended']['winRewardDetails'])) {
            foreach ($properties['extended']['winRewardDetails'] as $winRewardDetail) {
                foreach ($winRewardDetail['rewardItemHashes'] as $itemHash) {
                    $winDetails[$winRewardDetail['winCount']][] = manifest()->inventoryItem($itemHash);
                }
            }
        }

        $properties['winRewards'] = $winDetails;

        parent::__construct($properties);
    }

    /**
     * @return string
     */
    public static function getIdentifier()
    {
        return 'trials';
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return 'Trials';
    }
}

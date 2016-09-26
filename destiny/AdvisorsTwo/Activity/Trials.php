<?php namespace Destiny\AdvisorsTwo\Activity;

use Destiny\Advisors;
use Destiny\AdvisorsTwo\Activity;
use Destiny\Definitions\InventoryItem;

/**
 * @property string $progressionHash
 * @property InventoryItem[] $bounties
 */
class Trials extends Activity implements ActivityInterface
{
    public function __construct(Advisors $advisors, array $properties)
    {
    	$bounties = [];
        foreach ($properties['bountyHashes'] as $bountyHash)
        {
            $bounties[] = manifest()->inventoryItem($bountyHash);
        }

        $properties['bounties'] = $bounties;

        parent::__construct($properties);
    }

    /**
     * @return string
     */
    public static function getIdentifier()
    {
        return 'trials';
    }
}
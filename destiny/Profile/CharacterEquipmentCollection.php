<?php

declare(strict_types=1);

namespace Destiny\Profile;

use Destiny\Collection;
use Destiny\Definitions\Components\InstancedItem;
use Destiny\Definitions\Components\Inventory as InventoryDefinition;

/**
 * Class CharacterEquipmentCollection
 * @package Destiny\Profile
 */
class CharacterEquipmentCollection extends Collection
{
    public function __construct(array $properties, array $itemInstances)
    {
        $instanceItems = $itemInstances['instances']['data'] ?? null;
        $items = [];

        if (isset($properties['data'])) {
            foreach ($properties['data'] as $characterId => $bucket) {
                foreach ($bucket['items'] as $item) {

                    // Grab the specific instance of this data, if it exists
                    if (isset($instanceItems[$item['itemInstanceId']])) {
                        $item['instance'] = new InstancedItem($instanceItems[$item['itemInstanceId']]);
                    }
                    $items[$characterId][$item['bucketHash']] = new InventoryDefinition($item);
                }
            }
        }

        parent::__construct($items);
    }
}

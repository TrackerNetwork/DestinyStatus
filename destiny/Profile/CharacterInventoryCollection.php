<?php

declare(strict_types=1);

namespace Destiny\Profile;

use Destiny\Collection;
use Destiny\Definitions\Components\Inventory as InventoryComponent;

/**
 * Class CharacterInventoryCollection.
 */
class CharacterInventoryCollection extends Collection
{
    public function __construct(array $properties)
    {
        $items = [];

        if (isset($properties['data'])) {
            foreach ($properties['data'] as $characterId => $bucket) {
                foreach ($bucket['items'] as $item) {
                    $items[$characterId][$item['itemHash']] = new InventoryComponent($item);
                }
            }
        }

        parent::__construct($items);
    }
}

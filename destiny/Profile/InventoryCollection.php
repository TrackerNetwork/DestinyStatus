<?php

declare(strict_types=1);

namespace Destiny\Profile;

use Destiny\Collection;
use Destiny\Definitions\Components\Inventory as InventoryComponent;

/**
 * Class InventoryCollection.
 */
class InventoryCollection extends Collection
{
    public function __construct(array $properties)
    {
        $items = [];

        if (isset($properties['data']['items'])) {
            foreach ($properties['data']['items'] as $item) {
                $items[$item['itemHash']] = new InventoryComponent($item);
            }
        }

        parent::__construct($items);
    }
}

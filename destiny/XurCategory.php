<?php

namespace Destiny;

use Destiny\Definitions\InventoryItem;

/**
 * @property int $categoryIndex
 * @property string $categoryTitle
 * @property InventoryItem $items
 */
class XurCategory extends Model
{
    public function __construct(array $properties)
    {
        if (isset($properties['saleItems']) && is_array($properties['saleItems'])) {
            $items = [];
            foreach ($properties['saleItems'] as $saleItem) {
                $items[] = manifest()->inventoryItem($saleItem['item']['itemHash']);
            }

            $properties['items'] = $items;
        }

        parent::__construct($properties);
    }
}

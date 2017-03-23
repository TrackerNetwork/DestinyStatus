<?php

namespace Destiny;

use Destiny\Definitions\InventoryItem;

/**
 * @property string $vendorHash
 * @property string $nextRefreshDate
 * @property bool $enabled
 * @property bool $canPurchase
 * @property array $currencies
 * @property XurCategory $itemCategories
 * @property InventoryItem[] $weapons
 */
class Xur extends Model
{
    public function __construct(array $properties)
    {
        if (isset($properties['saleItemCategories']) && is_array($properties['saleItemCategories'])) {
            $categories = [];
            foreach ($properties['saleItemCategories'] as $saleItemCategory) {
                $categories[$saleItemCategory['categoryIndex']] = new XurCategory($saleItemCategory);
            }
            $properties['itemCategories'] = $categories;
        }

        parent::__construct($properties);
    }

    protected function gWeapons()
    {
        if (is_array($this->itemCategories)) {
            foreach ($this->itemCategories as $itemCategory) {
                if ($itemCategory->categoryTitle === 'Exotic Gear') {
                    return $itemCategory->items;
                }
            }
        }

        return [];
    }
}

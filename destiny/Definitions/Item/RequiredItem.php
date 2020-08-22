<?php

namespace Destiny\Definitions\Item;

use Destiny\Definitions\Definition;
use Destiny\Definitions\Manifest\InventoryItem;

/**
 * Class RequiredItem.
 *
 * @property int           $count
 * @property string        $itemHash
 * @property bool          $deleteOnAction
 * @property InventoryItem $item
 */
class RequiredItem extends Definition
{
    protected $appends = [
        'item',
    ];

    /**
     * @return \Destiny\Definitions\Manifest\InventoryItem
     */
    protected function gItem()
    {
        return app('destiny.manifest')->inventoryItem($this->itemHash);
    }
}

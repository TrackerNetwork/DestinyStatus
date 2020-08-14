<?php

namespace Destiny\Definitions\Item;

use Destiny\Definitions\Definition;

/**
 * Class Quantity.
 *
 * @property string $itemHash
 * @property int    $itemInstanceId
 * @property int    $quantity
 */
class Quantity extends Definition
{
    protected $appends = [
        'item',
    ];

    protected function gItem()
    {
        return manifest()->inventoryItem($this->itemHash);
    }
}

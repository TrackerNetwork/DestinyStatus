<?php

namespace Destiny\Definitions\Item;

use Destiny\Definitions\Definition;

/**
 * Class Quantity
 * @package Destiny\Definitions\Item
 * @property string $itemHash
 * @property int $itemInstanceId
 * @property int $quantity
 */
class Quantity extends Definition
{
    protected $appends = [
        'item'
    ];
}
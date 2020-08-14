<?php

namespace Destiny\Definitions\Item;

use Destiny\Definitions\Definition;

/**
 * Class Inventory.
 *
 * @property string $stackUniqueLabel
 * @property int    $maxStackSize
 * @property string $bucketTypeHash
 * @property string $recoveryBucketTypeHash
 * @property string $tierTypeHash
 * @property bool   $isInstanceItem
 * @property bool   $nonTransferrableOriginal
 * @property string $tierTypeName
 * @property int    $tierType
 */
class Inventory extends Definition
{
    protected $appends = [
    ];
}

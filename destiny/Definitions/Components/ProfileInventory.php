<?php

namespace Destiny\Definitions\Components;

use Destiny\Definitions\Definition;

/**
 * Class ProfileInventory.
 *
 * @package Destiny\Definitions\Components
 * @property string $itemHash
 * @property string $itemInstanceId
 * @property int $quantity
 * @property int $bindStatus
 * @property int $location
 * @property string $bucketHash
 * @property int $transferStatus
 * @property bool $lockable
 * @property int $state
 */
class ProfileInventory extends Definition
{
    protected $appends = [
    ];
}

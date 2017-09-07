<?php

namespace Destiny\Definitions\Components;

use Destiny\Definitions\Definition;
use Destiny\Definitions\Manifest\InventoryItem;

/**
 * Class Inventory.
 *
 * @property string $itemHash
 * @property string $itemInstanceId
 * @property int $quantity
 * @property int $bindStatus
 * @property int $location
 * @property string $bucketHash
 * @property int $transferStatus
 * @property bool $lockable
 * @property int $state
 * @property InventoryItem $definition
 * @property InstancedItem $instance
 */
class Inventory extends Definition
{
    /**
     * @var array
     */
    protected $damageTypes = [
        1 => ['name' => 'Kinetic', 'icon' => '/img/kinetic.png'],
        2 => ['name' => 'Arc',     'icon' => '/img/arc.png'],
        3 => ['name' => 'Solar',   'icon' => '/img/solar.png'],
        4 => ['name' => 'Void',    'icon' => '/img/void.png'],
    ];

    public function __construct($properties = null)
    {
        $properties['definition'] = manifest()->inventoryItem($properties['itemHash']);

        parent::__construct($properties);
    }

    protected function gPrimaryStat()
    {
        return $this->instance->primaryStat ?? null;
    }

    protected function gDamage()
    {
        return $this->instance->primaryStat['value'] ?? 0;
    }

    protected function gDamageType()
    {
        return $this->instance->damageType;
    }

    protected function gDamageTypeHash()
    {
        return $this->instance->damageTypeHash;
    }

    protected function gDamageTypeName()
    {
        return $this->instance->damage->name ?? null;
    }

    protected function gDamageTypeIcon()
    {
        return $this->instance->damage->display->icon ?? null;
    }
}

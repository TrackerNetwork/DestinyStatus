<?php

namespace Destiny\Definitions\Components;

use Destiny\Definitions\Definition;
use Destiny\Definitions\Manifest\InventoryItem;

/**
 * Class Inventory.
 *
 * @property string        $itemHash
 * @property string        $itemInstanceId
 * @property int           $quantity
 * @property int           $bindStatus
 * @property int           $location
 * @property string        $bucketHash
 * @property int           $transferStatus
 * @property bool          $lockable
 * @property int           $state
 * @property InventoryItem $definition
 * @property InstancedItem $instance
 * @property-read array $primaryStat
 * @property-read int $damage
 * @property-read int $damageType
 * @property-read string $damageTypeHash
 * @property-read string $damageTypeName
 * @property-read string $damageTypeIcon
 * @property-read bool $defense
 */
class Inventory extends Definition
{
    /**
     * @var array
     */
    protected $damageTypes = [
        1 => ['name' => 'Kinetic', 'icon' => '/img/damage/kinetic.png'],
        2 => ['name' => 'Arc',     'icon' => '/img/damage/arc.png'],
        3 => ['name' => 'Solar',   'icon' => '/img/damage/solar.png'],
        4 => ['name' => 'Void',    'icon' => '/img/damage/void.png'],
    ];

    public function __construct($properties = null)
    {
        $properties['definition'] = app('destiny.manifest')->inventoryItem($properties['itemHash']);

        parent::__construct($properties);
    }

    protected function gDefense()
    {
        return $this->instance->damageType == 0 && $this->instance->primaryStat['value'] > 1;
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
        $damage = $this->instance->damage;

        return ($damage !== null) ? $damage->display->name : null;
    }

    protected function gDamageTypeIcon()
    {
        if (isset($this->damageTypes[$this->damageType])) {
            return asset($this->damageTypes[$this->damageType]['icon'], !\App::isLocal());
        }
    }
}

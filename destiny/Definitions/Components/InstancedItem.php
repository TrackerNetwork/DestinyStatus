<?php

namespace Destiny\Definitions\Components;

use Destiny\Definitions\Definition;
use Destiny\Definitions\Manifest\DamageType;

/**
 * Class InstancedItem.
 *
 * @property int    $damageType
 * @property string $damageTypeHash
 * @property array  $primaryStat
 * @property int    $itemLevel
 * @property int    $quality
 * @property bool   $isEquipped
 * @property bool   $canEquip
 * @property int    $equipRequiredLevel
 * @property array  $unlockHashesRequiredToEquip
 * @property int    $cannotEquipReason
 * @property-read DamageType $damage
 */
class InstancedItem extends Definition
{
    protected $appends = [
    ];

    protected function gDamage()
    {
        if ($this->damageType > 0) {
            return app('destiny.manifest')->damageTypes($this->damageTypeHash);
        }
    }
}

<?php

declare(strict_types=1);

namespace Destiny\Character;

use Destiny\Model;

/**
 * Class Inventory.
 *
 * @property \Destiny\Definitions\Components\Inventory $subclass
 * @property \Destiny\Definitions\Components\Inventory $primaryWeapon
 * @property \Destiny\Definitions\Components\Inventory $secondaryWeapon
 * @property \Destiny\Definitions\Components\Inventory $heavyWeapon
 * @property \Destiny\Definitions\Components\Inventory $ghost
 * @property \Destiny\Definitions\Components\Inventory $helmet
 * @property \Destiny\Definitions\Components\Inventory $arms
 * @property \Destiny\Definitions\Components\Inventory $chest
 * @property \Destiny\Definitions\Components\Inventory $boots
 * @property \Destiny\Definitions\Components\Inventory $classItem
 * @property \Destiny\Definitions\Components\Inventory $emblem
 * @property \Destiny\Definitions\Components\Inventory $aura
 * @property \Destiny\Definitions\Components\Inventory $sparrow
 * @property \Destiny\Definitions\Components\Inventory $ship
 * @property \Destiny\Definitions\Components\Inventory $emote
 *
 */
class Inventory extends Model
{
    const BUCKET_SUBCLASS = '3284755031';
    const BUCKET_KINETIC_WEAPONS = '1498876634';
    const BUCKET_ENERGY_WEAPONS = '2465295065';
    const BUCKET_POWER_WEAPONS = '953998645';
    const BUCKET_HEAD = '3448274439';
    const BUCKET_ARMS = '3551918588';
    const BUCKET_CHEST = '14239492';
    const BUCKET_LEGS = '20886954';
    const BUCKET_CLASS = '1585787867';
    const BUCKET_GHOST = '4023194814';
    const BUCKET_VEHICLES = '2025709351';
    const BUCKET_SHIPS = '284967655';
    const BUCKET_EMBLEMS = '4274335291';
    const BUCKET_EMOTES = '3054419239';
    const BUCKET_AURA = '1269569095';

    protected function gItems($key)
    {
        return $this->properties[$key] ?? null;
    }

    protected function gSubclass()
    {
        return $this->gItems(self::BUCKET_SUBCLASS);
    }

    protected function gPrimaryWeapon()
    {
        return $this->gItems(self::BUCKET_KINETIC_WEAPONS);
    }

    protected function gSecondaryWeapon()
    {
        return $this->gItems(self::BUCKET_ENERGY_WEAPONS);
    }

    protected function gHeavyWeapon()
    {
        return $this->gItems(self::BUCKET_POWER_WEAPONS);
    }

    protected function gGhost()
    {
        return $this->gItems(self::BUCKET_GHOST);
    }

    protected function gHelmet()
    {
        return $this->gItems(self::BUCKET_HEAD);
    }

    protected function gArms()
    {
        return $this->gItems(self::BUCKET_ARMS);
    }

    protected function gChest()
    {
        return $this->gItems(self::BUCKET_CHEST);
    }

    protected function gBoots()
    {
        return $this->gItems(self::BUCKET_LEGS);
    }

    protected function gClassItem()
    {
        return $this->gItems(self::BUCKET_CLASS);
    }

    protected function gSparrow()
    {
        return $this->gItems(self::BUCKET_VEHICLES);
    }

    protected function gShip()
    {
        return $this->gItems(self::BUCKET_SHIPS);
    }

    protected function gEmblem()
    {
        return $this->gItems(self::BUCKET_EMBLEMS);
    }

    protected function gAura()
    {
        return $this->gItems(self::BUCKET_AURA);
    }

    protected function gEmote()
    {
        return $this->gItems(self::BUCKET_EMOTES);
    }
}

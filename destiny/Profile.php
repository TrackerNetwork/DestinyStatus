<?php

declare(strict_types=1);

namespace Destiny;

use App\Account;
use Destiny\Profile\CharacterActivityCollection;
use Destiny\Profile\CharacterCollection;
use Destiny\Profile\CharacterInventoryCollection;
use Destiny\Profile\CharacterProgressionCollection;
use Destiny\Profile\CurrencyCollection;
use Destiny\Profile\InventoryCollection;
use Destiny\Profile\KioskItemCollection;
use Destiny\Profile\VendorReceiptCollection;

/**
 * Class Profile.
 *
 * @property VendorReceiptCollection $vendorReceipts
 * @property InventoryCollection $profileInventory
 * @property CurrencyCollection $profileCurrencies
 * @property \Destiny\Profile\Profile $profile
 * @property KioskItemCollection $profileKiosks
 * @property CharacterCollection $characters
 * @property CharacterInventoryCollection $characterInventories
 * @property CharacterProgressionCollection $characterProgressions
 * @property array $characterRenderData
 * @property CharacterActivityCollection $characterActivities
 * @property array $characterEquipment
 * @property array $characterKiosks
 * @property array $itemComponents
 * @property Account $account
 */
class Profile extends Model
{
    protected $appends = [
        'profileCurrencies',
        'profile',
        'characters',
        'characterInventories',
        'characterProgressions',
    ];

    public function __construct(Account $account, array $properties)
    {
        $properties['account'] = $account;
        parent::__construct($properties);
    }

    protected function gVendorReceipts()
    {
        return new VendorReceiptCollection($this->properties['vendorReceipts']);
    }

    protected function gProfileInventory()
    {
        return new InventoryCollection($this->properties['profileInventory']);
    }

    protected function gProfileCurrencies()
    {
        return new CurrencyCollection($this->properties['profileCurrencies']);
    }

    protected function gProfile()
    {
        return new \Destiny\Profile\Profile($this->properties['profile']);
    }

    protected function gProfileKiosks()
    {
        return new KioskItemCollection($this->properties['profileKiosks']);
    }

    protected function gCharacters()
    {
        return new CharacterCollection($this->properties['characters']);
    }

    protected function gCharacterInventories()
    {
        return new CharacterInventoryCollection($this->properties['characterInventories']);
    }

    protected function gCharacterProgressions()
    {
        return new CharacterProgressionCollection($this->properties['characterProgressions']);
    }

    protected function gCharacterActivities()
    {
        return new CharacterActivityCollection($this->properties['characterActivities']);
    }

    protected function gAccount()
    {
        return $this->properties['account'];
    }
}

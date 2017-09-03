<?php

declare(strict_types=1);

namespace Destiny;

use App\Account;
use Destiny\Profile\ProfileInventory;
use Destiny\Profile\VendorReceipt;

/**
 * Class Profile.
 *
 * @property VendorReceipt $vendorReceipts
 * @property ProfileInventory $profileInventory
 * @property Account $account
 */
class Profile extends Model
{
    protected $appends = [
        'vendorReceipts',
        'profileInventory'
    ];

    public function __construct(Account $account, array $properties)
    {
        $properties['account'] = $account;
        parent::__construct($properties);
    }

    protected function gVendorReceipts()
    {
        return new VendorReceipt($this->properties['vendorReceipts']);
    }

    protected function gProfileInventory()
    {
        return new ProfileInventory($this->properties['profileInventory']);
    }

    protected function gAccount()
    {
        return $this->properties['account'];
    }
}

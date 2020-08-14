<?php

namespace Destiny\Definitions\Components;

use Destiny\Definitions\Definition;
use Destiny\Definitions\Item\Quantity;

/**
 * Class VendorReceipt.
 *
 * @property array    $currencyPaid
 * @property array    $itemReceived
 * @property string   $licenseUnlockHash
 * @property string   $purchasedByCharacterId
 * @property int      $refundPolicy
 * @property string   $sequenceNumber
 * @property string   $timeToExpiration
 * @property string   $expiresOn
 * @property Quantity $currency
 * @property Quantity $item
 */
class VendorReceipt extends Definition
{
    protected $appends = [
    ];

    public function gCurrency()
    {
        return new Quantity($this->currencyPaid);
    }

    public function gItem()
    {
        return new Quantity($this->itemReceived);
    }
}

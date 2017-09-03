<?php

declare(strict_types=1);

namespace Destiny\Profile;

use Destiny\Collection;
use Destiny\Definitions\Components\VendorReceipt as VendorReceiptDefinition;

/**
 * Class VendorReceiptCollection
 * @package Destiny\Profile
 */
class VendorReceiptCollection extends Collection
{
    public function __construct(array $properties)
    {
        $receipts = [];

        if (isset($properties['data']['receipts'])) {
            foreach ($properties['data']['receipts'] as $receipt) {
                $receipts[$receipt['licenseUnlockHash']] = new VendorReceiptDefinition($receipt);
            }
        }

        parent::__construct($receipts);
    }
}

<?php

declare(strict_types=1);

namespace Destiny\Profile;

use Destiny\Collection;
use Destiny\Definitions\Components\Inventory as InventoryComponent;

/**
 * Class ProfileCurrencyCollection
 * @package Destiny\Profile
 */
class ProfileCurrencyCollection extends Collection
{
    public function __construct(array $properties)
    {
        $currencies = [];

        if (isset($properties['data']['items'])) {
            foreach ($properties['data']['items'] as $currency) {
                $currencies[$currency['itemHash']] = new InventoryComponent($currency);
            }
        }

        parent::__construct($currencies);
    }
}

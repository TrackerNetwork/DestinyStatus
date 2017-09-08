<?php

declare(strict_types=1);

namespace Destiny\Profile;

use Destiny\Collection;
use Destiny\Definitions\Components\Inventory as InventoryComponent;

/**
 * Class CurrencyCollection.
 */
class CurrencyCollection extends Collection
{
    public function __construct(array $properties)
    {
        $currencies = [];

        if (isset($properties['data']['items'])) {
            foreach ($properties['data']['items'] as $item) {
                $currencies[$item['itemHash']] = new InventoryComponent($item);
            }
        }

        parent::__construct($currencies);
    }
}

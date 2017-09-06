<?php

declare(strict_types=1);

namespace Destiny\Profile;

use App\Enums\PrivacySetting;
use Destiny\Collection;
use Destiny\Definitions\Components\Inventory as InventoryComponent;

/**
 * Class CurrencyCollection
 * @package Destiny\Profile
 */
class CurrencyCollection extends Collection
{
    public function __construct(array $properties)
    {
        $currencies = [];

        if ($properties['privacy'] != PrivacySetting::Private) {
            if (isset($properties['data']['items'])) {
                foreach ($properties['data']['items'] as $item) {
                    $currencies[$item['itemHash']] = new InventoryComponent($item);
                }
            }
        }

        parent::__construct($currencies);
    }
}
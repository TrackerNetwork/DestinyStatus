<?php

declare(strict_types=1);

namespace Destiny\Profile;

use Destiny\Collection;
use Destiny\Definitions\Components\ProfileInventory as ProfileInventoryDefinition;

/**
 * Class ProfileInventory
 * @package Destiny\Profile
 */
class ProfileInventory extends Collection
{
    public function __construct(array $properties)
    {
        $items = [];

        if (isset($properties['data']['items'])) {
            foreach ($properties['data']['items'] as $item) {
                $items[$item['itemHash']] = new ProfileInventoryDefinition($item);
            }
        }

        parent::__construct($items);
    }
}
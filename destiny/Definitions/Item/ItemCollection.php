<?php

declare(strict_types=1);

namespace Destiny\Definitions\Item;

use Illuminate\Support\Collection;

/**
 * @method Quantity offsetGet($key)
 */
class ItemCollection extends Collection
{
    /**
     * RewardCategoryCollection constructor.
     *
     * @param array $properties
     */
    public function __construct(array $properties)
    {
        $items = [];
        foreach ($properties as $item) {
            $items[$item['itemHash']] = new Quantity($item);
        }

        parent::__construct($items);
    }
}

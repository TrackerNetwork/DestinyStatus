<?php

declare(strict_types=1);

namespace Destiny\Profile;

use Destiny\Collection;
use Destiny\Definitions\Components\KioskItem as KioskItemDefinition;

/**
 * Class KioskItemCollection.
 */
class KioskItemCollection extends Collection
{
    public function __construct(array $properties)
    {
        $items = [];

        if (isset($properties['data']['kioskItems'])) {
            foreach ($properties['data']['kioskItems'] as $item) {
                // Not sure why the kioskItems are contained in an array of their own.
                // This will probably make sense when real API data comes out
                if (isset($item['index'])) {
                    $items[] = new KioskItemDefinition($item);
                } else {
                    foreach ($item as $_item) {
                        $items[] = new KioskItemDefinition($_item);
                    }
                }
            }
        }

        parent::__construct($items);
    }
}

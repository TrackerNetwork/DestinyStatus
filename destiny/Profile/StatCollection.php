<?php

declare(strict_types=1);

namespace Destiny\Profile;

use Destiny\Collection;
use Destiny\Definitions\Stat\Entry;

/**
 * Class StatCollection.
 */
class StatCollection extends Collection
{
    public function __construct(array $properties)
    {
        $items = [];
        foreach ($properties as $statHash => $value) {
            $item = app('destiny.manifest')->stat((string) $statHash)->toArray();
            $items[$statHash] = new Entry($item, (string) $value);
        }

        parent::__construct($items);
    }
}

<?php

declare(strict_types=1);

namespace Destiny\Profile;

use Destiny\Collection;
use Destiny\Definitions\Components\Activity as ActivityComponent;

/**
 * Class CharacterActivityCollection.
 */
class CharacterActivityCollection extends Collection
{
    public function __construct(array $properties)
    {
        $items = [];

        if (isset($properties['data'])) {
            foreach ($properties['data'] as $characterId => $bucket) {
                $items[$characterId][] = new ActivityComponent($bucket);
            }
        }

        parent::__construct($items);
    }
}
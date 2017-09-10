<?php

declare(strict_types=1);

namespace Destiny\Activity;

use Destiny\Definitions\Manifest\Activity;
use Illuminate\Support\Collection;

/**
 * @method Activity offsetGet($key)
 */
class ActivityCollection extends Collection
{
    /**
     * MilestoneCollection constructor.
     *
     * @param array $items
     */
    public function __construct(array $items)
    {
        $variants = [];
        foreach ($items as $item) {
            $variants[$item['activityHash']] = manifest()->activity((string) $item['activityHash']);
        }

        parent::__construct($variants);
    }
}

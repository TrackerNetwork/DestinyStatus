<?php

declare(strict_types=1);

namespace Destiny\Activity;

use Destiny\Definitions\Manifest\ActivityModifier;
use Illuminate\Support\Collection;

/**
 * @method ActivityModifier offsetGet($key)
 */
class ModifierCollection extends Collection
{
    /**
     * MilestoneCollection constructor.
     *
     * @param array $items
     */
    public function __construct(array $items)
    {
        $modifiers = [];
        foreach ($items as $item) {
            $modifiers[$item] = app('destiny.manifest')->activityModifier((string) $item);
        }

        parent::__construct($modifiers);
    }
}

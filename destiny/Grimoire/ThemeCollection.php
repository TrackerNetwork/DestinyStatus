<?php

namespace Destiny\Grimoire;

use Destiny\Collection;
use Destiny\Grimoire;

/**
 * @method \Destiny\Grimoire\Theme offsetGet($key)
 */
class ThemeCollection extends Collection
{
    public function __construct(Grimoire $grimoire, array $items)
    {
        foreach ($items as $properties) {
            $theme = new Theme($grimoire, $properties);
            $this->items[$theme->themeId] = $theme;
        }
    }
}

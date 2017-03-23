<?php

namespace Destiny\Grimoire;

use Destiny\Collection;

/**
 * @method \Destiny\Grimoire\Page offsetGet($key)
 */
class PageCollection extends Collection
{
    public function __construct(Theme $theme, array $items)
    {
        foreach ($items as $properties) {
            $page = new Page($theme, $properties);
            $this->items[$page->pageId] = $page;
        }
    }
}

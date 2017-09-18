<?php

namespace Destiny\Definitions\Milestone;

use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;

/**
 * Class Value.
 *
 * @property string $key
 * @property array $displayProperties
 * @property DisplayProperties $display
 */
class Value extends Definition
{
    protected $appends = [
        'display'
    ];

    protected function gDisplay()
    {
        return new DisplayProperties($this->displayProperties);
    }
}

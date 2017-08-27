<?php

namespace Destiny\Definitions\Milestone;

use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;

/**
 * Class Value.
 *
 * @property string $key
 * @property DisplayProperties $displayProperties
 */
class Value extends Definition
{
    protected $appends = [
        'displayProperties',
    ];
}

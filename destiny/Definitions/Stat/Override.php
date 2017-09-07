<?php

namespace Destiny\Definitions\Stat;

use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;

/**
 * Class Override.
 *
 * @property string $statHash
 * @property DisplayProperties $displayProperties
 */
class Override extends Definition
{
    protected $appends = [
        'displayProperties',
    ];
}

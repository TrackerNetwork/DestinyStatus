<?php

namespace Destiny\Definitions\Manifest;

use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;

/**
 * Class Place.
 *
 * @property DisplayProperties $displayProperties
 * @property string            $hash
 * @property int               $index
 * @property bool              $redacted
 */
class Place extends Definition
{
    protected $appends = [
        'displayProperties',
    ];
}

<?php

namespace Destiny\Definitions\Manifest;

use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;

/**
 * Class Gender.
 *
 * @property array             $displayProperties
 * @property string            $hash
 * @property int               $index
 * @property bool              $redacted
 * @property DisplayProperties $display
 */
class Gender extends Definition
{
    protected $appends = [
        'display',
    ];

    protected function gDisplay()
    {
        return new DisplayProperties($this->displayProperties);
    }
}

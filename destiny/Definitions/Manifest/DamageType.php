<?php

namespace Destiny\Definitions\Manifest;

use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;

/**
 * Class DamageType.
 *
 * @property array             $displayProperties
 * @property string            $transparentIconPath
 * @property bool              $showIcon
 * @property int               $enumValue
 * @property string            $hash
 * @property int               $index
 * @property bool              $redacted
 * @property DisplayProperties $display
 */
class DamageType extends Definition
{
    protected $appends = [
        'display',
    ];

    protected function gDisplay()
    {
        return new DisplayProperties($this->displayProperties);
    }

    protected function gName()
    {
        return $this->display->name;
    }
}

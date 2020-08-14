<?php

namespace Destiny\Definitions\Stat;

use Destiny\Definitions\Definition;
use Destiny\Definitions\InterpolationPoint;

/**
 * Class Display.
 *
 * @property string $statHash
 * @property int    $maximumValue
 * @property bool   $displayAsNumeric
 * @property array  $displayInterpolation (InterpolationPoint)
 * @property-read InterpolationPoint $interpolationPoint
 */
class Display extends Definition
{
    protected $appends = [
        'interpolationPoint',
    ];

    protected function gInterpolationPoint()
    {
        return new InterpolationPoint($this->displayInterpolation);
    }
}

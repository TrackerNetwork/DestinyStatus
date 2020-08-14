<?php

namespace Destiny\Definitions\Vendor;

use Destiny\Definitions\Definition;

/**
 * Class Action.
 *
 * @property string $description
 * @property int    $executeSeconds
 * @property string $icon
 * @property string $name
 * @property string $verb
 * @property bool   $isPositive
 * @property string $actionId
 * @property int    $actionHash
 * @property bool   $autoPerformAction
 */
class Action extends Definition
{
    protected $appends = [
    ];
}

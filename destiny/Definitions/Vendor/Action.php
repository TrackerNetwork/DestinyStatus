<?php

namespace Destiny\Definition\Vendor;

use Destiny\Definitions\Definition;

/**
 * Class Action
 * @package Destiny\Definition\VEndor
 * @property string $description
 * @property int $executeSeconds
 * @property string $icon
 * @property string $name
 * @property string $verb
 * @property bool $isPositive
 * @property string $actionId
 * @property int $actionHash
 * @property bool $autoPerformAction
 */
class Action extends Definition
{
    protected $appends = [
    ];
}
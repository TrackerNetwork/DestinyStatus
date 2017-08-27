<?php

namespace Destiny\Definitions\Manifest;

use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;

/**
 * Class InventoryItem.
 *
 * @property DisplayProperties $displayProperties
 * @property string $secondaryIcon
 * @property string $secondaryOverlay
 * @property string $secondarySpecial
 * @property string $screenshot
 * @property string $itemTypeDisplayName
 * @property string $itemTypeAndTierDisplayName
 * @property string $displaySource
 * @property string $tooltipStyle
 * @property string $action
 */
class InventoryItem extends Definition
{
    protected $appends = [
        'displayProperties',
    ];
}

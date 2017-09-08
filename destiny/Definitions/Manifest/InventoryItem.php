<?php

namespace Destiny\Definitions\Manifest;

use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;
use Destiny\Definitions\Item\Inventory;

/**
 * Class InventoryItem.
 *
 * @property array $displayProperties
 * @property string $secondaryIcon
 * @property string $secondaryOverlay
 * @property string $secondarySpecial
 * @property string $screenshot
 * @property string $itemTypeDisplayName
 * @property string $itemTypeAndTierDisplayName
 * @property string $displaySource
 * @property string $tooltipStyle
 * @property array $action
 * @property array $inventory
 * @property array $stats
 * @property array $equippingBlock
 * @property array $quality
 * @property array $sourceData
 * @property array $talentGrid
 * @property array $investmentStats
 * @property array $perks
 * @property string $loreHash
 * @property bool $allowActions
 * @property bool $nonTransferrable
 * @property array $itemCategoryHashes
 * @property int $specialItemType
 * @property int $itemType
 * @property int $itemSubType
 * @property int $classType
 * @property bool $equippable
 * @property int $defaultDamageType
 * @property string $hash
 * @property int $index
 * @property bool $redacted
 * @property-read Lore $lore
 * @property-read DisplayProperties $display
 * @property-read string $itemName
 * @property-read string $tierName
 * @property-read string $itemIcon
 * @property-read string $loreSubtitle
 * @property-read Inventory $tierInfo
 */
class InventoryItem extends Definition
{
    protected $appends = [
        'display',
        'tierInfo',
    ];

    protected function gLore()
    {
        return manifest()->lore((string) $this->loreHash);
    }

    protected function gDisplay()
    {
        return new DisplayProperties($this->displayProperties);
    }

    protected function gItemName()
    {
        return $this->display->name;
    }

    protected function gTierName()
    {
        return $this->tierInfo->tierTypeName;
    }

    protected function gLoreSubtitle()
    {
        if (empty($this->loreHash)) {
            return $this->display->description;
        }

        return $this->lore->subtitle;
    }

    protected function gItemIcon()
    {
        if ($this->redacted) {
            return '/img/misc/missing_icon.png';
        }
        return $this->display->icon;
    }

    protected function gTierInfo()
    {
        return new Inventory($this->inventory);
    }
}

<?php

namespace Destiny\Definitions\Manifest;

use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;

/**
 * Class Vendor.
 *
 * @property array             $displayProperties
 * @property string            $buyString
 * @property string            $sellString
 * @property string            $displayItemHash             (InventoryItem)
 * @property bool              $inhibitBuying
 * @property bool              $inhibitSelling
 * @property string            $factionHash                 (Faction)
 * @property int               $resetIntervalMinutes
 * @property array             $failureStrings
 * @property array             $unlockRanges                (DateRange)
 * @property string            $vendorIdentifier
 * @property string            $vendorPortrait
 * @property string            $vendorBanner
 * @property bool              $enabled
 * @property bool              $visible
 * @property string            $vendorCategoryIdentifier
 * @property string            $vendorSubcategoryIdentifier
 * @property bool              $consolidateCategories
 * @property array             $actions                     (Vendor/Action)
 * @property array             $categories                  (Vendor/CategoryEntry)
 * @property array             $originalCategories          (Vendor/CategoryEntry)
 * @property array             $displayCategories           (Common/DisplayCategory)
 * @property array             $interactions
 * @property array             $inventoryFlyouts
 * @property array             $itemList
 * @property array             $services
 * @property array             $acceptedItems
 * @property string            $hash
 * @property int               $index
 * @property bool              $redacted
 * @property DisplayProperties $display
 */
class Vendor extends Definition
{
    const STAT_CHAR_AVERAGE = 0;
    const STAT_CHARACTER = 1;
    const STAT_ITEM = 2;

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

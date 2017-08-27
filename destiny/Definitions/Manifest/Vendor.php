<?php

namespace Destiny\Definitions\Manifest;

use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;

/**
 * Class Vendor.
 *
 * @property DisplayProperties $displayProperties
 * @property string $buyString
 * @property string $sellString
 * @property string $displayItemHash (InventoryItem)
 * @property bool $inhibitBuying
 * @property bool $inhibitSelling
 * @property string $factionHash (Faction)
 * @property int $resetIntervalMinutes
 * @property array $failureStrings
 * @property array $unlockRanges (DateRange)
 * @property string $vendorIdentifier
 * @property string $vendorPortrait
 * @property string $vendorBanner
 * @property bool $enabled
 * @property bool $visible
 * @property string $vendorCategoryIdentifier
 * @property string $vendorSubcategoryIdentifier
 * @property bool $consolidateCategories
 * @property array $actions (Vendor/Action)
 * @property array $categories (Vendor/CategoryEntry)
 * @property array $originalCategories (Vendor/CategoryEntry)
 * @property array $displayCategories (Common/DisplayCategory)
 * @property array $interactions (@todo - https://bungie-net.github.io/multi/schema_Destiny-Definitions-DestinyVendorInteractionDefinition.html#schema_Destiny-Definitions-DestinyVendorInteractionDefinition)
 * @property array $inventoryFlyouts (@todo - https://bungie-net.github.io/multi/schema_Destiny-Definitions-DestinyVendorInventoryFlyoutDefinition.html#schema_Destiny-Definitions-DestinyVendorInventoryFlyoutDefinition)
 * @property array $itemList (@todo - https://bungie-net.github.io/multi/schema_Destiny-Definitions-DestinyVendorItemDefinition.html#schema_Destiny-Definitions-DestinyVendorItemDefinition)
 * @property array $services (@todo - https://bungie-net.github.io/multi/schema_Destiny-Definitions-DestinyVendorServiceDefinition.html#schema_Destiny-Definitions-DestinyVendorServiceDefinition)
 * @property array $acceptedItems (@todo - https://bungie-net.github.io/multi/schema_Destiny-Definitions-DestinyVendorAcceptedItemDefinition.html#schema_Destiny-Definitions-DestinyVendorAcceptedItemDefinition)
 * @property string $hash
 * @property int $index
 * @property bool $redacted
 */
class Vendor extends Definition
{
    const STAT_CHAR_AVERAGE = 0;
    const STAT_CHARACTER = 1;
    const STAT_ITEM = 2;

    protected $appends = [
        'displayProperties',
    ];
}

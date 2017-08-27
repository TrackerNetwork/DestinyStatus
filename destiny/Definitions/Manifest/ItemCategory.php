<?php

namespace Destiny\Definitions\Manifest;

use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;

/**
 * Class ItemCategory.
 *
 * @property DisplayProperties $displayProperties
 * @property bool $visible
 * @property string $shortTitle
 * @property string $itemTypeRegex
 * @property string $itemTypeRegexNot
 * @property string $originBucketIdentifier
 * @property int $grantDestinyItemType (ItemType)
 * @property int $grantDestinySubType (ItemSubType)
 * @property int $grantDestinyClass (Class)
 * @property array $groupedCategoryHashes (ItemCategory)
 * @property string $hash
 * @property int $index
 * @property bool $redacted
 */
class ItemCategory extends Definition
{
    protected $appends = [
        'displayProperties',
    ];
}

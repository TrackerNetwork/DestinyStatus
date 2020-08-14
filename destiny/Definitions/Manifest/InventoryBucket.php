<?php

namespace Destiny\Definitions\Manifest;

use Destiny\Definitions\Common\DisplayProperties;
use Destiny\Definitions\Definition;

/**
 * Class InventoryBucket.
 *
 * @property DisplayProperties $displayProperties
 * @property int               $scope
 * @property int               $category
 * @property int               $bucketOrder
 * @property int               $itemCount
 * @property int               $location
 * @property bool              $hasTransferDestination
 * @property bool              $enabled
 * @property bool              $fifo
 * @property string            $hash
 * @property int               $index
 * @property bool              $redacted
 */
class InventoryBucket extends Definition
{
    const SCOPE_CHARACTER = 0;
    const SCOPE_ACCOUNT = 1;

    const BUCKET_INVISIBLE = 0;
    const BUCKET_ITEM = 1;
    const BUCKET_CURRENCY = 2;
    const BUCKET_EQUIPPABLE = 3;
    const BUCKET_IGNORED = 4;

    const LOCATION_UNKNOWN = 0;
    const LOCATION_INVENTORY = 1;
    const LOCATION_VAULT = 2;
    const LOCATION_VENDOR = 3;
    const LOCATION_POSTMASTER = 4;

    protected $appends = [
        'displayProperties',
    ];

    public function isCharacter(): bool
    {
        return $this->scope == self::SCOPE_CHARACTER;
    }
}

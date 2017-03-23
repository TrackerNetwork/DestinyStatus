<?php

namespace Destiny\Definitions;

/**
 * @property string $itemHash
 * @property string $itemName
 * @property string $itemDescription
 * @property string $itemIdentifier
 * @property string $icon
 * @property string $secondaryIcon
 * @property string $actionName
 * @property bool $hasAction
 * @property bool $deleteOnAction
 * @property string $tierTypeName
 * @property int $tierType
 * @property string $itemTypeName
 * @property string $bucketTypeHash
 * @property string $primaryBaseStatHash
 * @property array $stats
 * @property array $perkHashes
 * @property int $specialItemType
 * @property string $talentGridHash
 * @property array $equippingBlock
 * @property bool $hasGeometry
 * @property string $statGroupHash
 * @property array $itemLevels
 * @property int $qualityLevel
 * @property bool $equippable
 * @property bool $instanced
 * @property string $rewardItemHash
 * @property array $values
 * @property int $itemType
 * @property int $itemSubType
 * @property int $classType
 * @property array $sourceHashes
 * @property bool $nonTransferrable
 * @property int $exclusive
 * @property int $maxStackSize
 */
class InventoryItem extends Definition
{
    protected function gItemHash($value)
    {
        return (string) $value;
    }

    protected function gBucketTypeHash($value)
    {
        return (string) $value;
    }

    protected function gPrimaryBaseStatHash($value)
    {
        return (string) $value;
    }

    protected function gTalentGridHash($value)
    {
        return (string) $value;
    }

    protected function gStatGroupHash($value)
    {
        return (string) $value;
    }
}

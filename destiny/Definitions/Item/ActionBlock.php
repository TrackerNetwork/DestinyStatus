<?php

namespace Destiny\Definitions\Item;

use Destiny\Definitions\Definition;

/**
 * Class ActionBlock.
 *
 * @property string $verbName
 * @property string $verbDescription
 * @property bool $isPositive
 * @property string $overlayScreenName
 * @property string $overlayIcon
 * @property int $requiredCooldownSeconds
 * @property array $requiredItems (ActionBlock)
 * @property array $progressionRewards (Reward)
 * @property string $actionTypeLabel
 * @property string $requiredLocation
 * @property string $requiredCooldownHash
 * @property bool $deleteOnAction
 * @property bool $consumeEntireStack
 * @property bool $useOnAcquire
 */
class ActionBlock extends Definition
{
    protected $appends = [
        'item',
    ];
}

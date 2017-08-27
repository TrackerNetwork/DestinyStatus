<?php

namespace Destiny\Definition\Vendor;

use Destiny\Definitions\Definition;

/**
 * Class CategoryEntry.
 *
 * @property int $categoryIndex
 * @property string $categoryId
 * @property string $categoryHash
 * @property int $quantityAvailable
 * @property bool $showUnavailableItems
 * @property bool $hideIfNoCurrency
 * @property bool $hideFromRegularPurchase
 * @property string $buyStringOverride
 * @property string $disabledDescription
 * @property string $displayTitle
 * @property array $overlay (CategoryOverlay)
 */
class CategoryEntry extends Definition
{
    protected $appends = [
    ];
}

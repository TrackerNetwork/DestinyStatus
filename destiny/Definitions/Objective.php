<?php

namespace Destiny\Definitions;

/**
 * @property string $objectiveHash
 * @property int $unlockValueHash
 * @property int $completionValue
 * @property int $vendorHash
 * @property int $vendorCategoryHash
 * @property string $displayDescription
 * @property int $locationHash
 * @property bool $allowNegativeValue
 * @property bool $allowValueChangeWhenCompleted
 * @property bool $isCountingDownward
 * @property int $valueStyle
 * @property string $hash
 * @property int $index
 * @property bool $redacted
 */
class Objective extends Definition
{
    protected function gValue()
    {
        return number_format($this->completionValue);
    }
}

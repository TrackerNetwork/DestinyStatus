<?php

namespace Destiny\AdvisorsTwo;

use Destiny\Definitions\InventoryItem as ItemDefinition;

/**
 * @property int $value
 * @property string $quantity
 * @property int $activityLevel
 */
class Reward extends ItemDefinition
{
    public function __construct($level, array $properties)
    {
        $properties['activityLevel'] = $level;
        parent::__construct($properties);

        $this->extend(manifest()->inventoryItem($this->itemHash));
    }

    protected function gValue($value)
    {
        return $value;
    }

    protected function gQuantity()
    {
        if ($this->value > 0) {
            return sprintf('&times; %s', $this->value);
        }
    }
}

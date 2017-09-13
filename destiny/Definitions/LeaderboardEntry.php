<?php

namespace Destiny\Definitions;

/**
 * Class LeaderboardEntry.
 *
 * @property int $rank
 * @property array $player
 * @property string $characterId
 * @property mixed $value
 * @property-read string $displayValue
 * @property-read string $formattedValue
 * @property string $name
 */
class LeaderboardEntry extends Definition
{
    protected function gValue()
    {
        return array_get($this->properties, 'value.basic.value');
    }

    protected function gDisplayValue()
    {
        return array_get($this->properties, 'value.basic.displayValue');
    }

    protected function gFormattedValue()
    {
        return number_format(array_get($this->properties, 'value.basic.value'));
    }

    protected function gName()
    {
        return array_get($this->properties, 'player.destinyUserInfo.displayName');
    }
}

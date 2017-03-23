<?php

namespace Destiny;

/**
 * @property string $statId
 * @property string $statName
 * @property mixed $value
 * @property string $displayValue
 * @property string $formattedValue
 * @property \Destiny\Definitions\HistoricalStats $definition
 */
class Statistic extends Model
{
    protected function gDefinition()
    {
        return manifest()->historicalStats($this->statId);
    }

    protected function gStatName()
    {
        return $this->definition->statName;
    }

    protected function gValue()
    {
        return array_get($this->properties, 'basic.value');
    }

    protected function gDisplayValue()
    {
        return array_get($this->properties, 'basic.displayValue');
    }

    protected function gFormattedValue()
    {
        return number_format(array_get($this->properties, 'basic.value'));
    }
}

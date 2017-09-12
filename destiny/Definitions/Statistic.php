<?php

namespace Destiny\Definitions;

use Destiny\Definitions\Manifest\HistoricalStat;

/**
 * @property string $statId
 * @property string $statName
 * @property mixed $value
 * @property string $displayValue
 * @property string $formattedValue
 * @property HistoricalStat $definition
 */
class Statistic extends Definition
{
    protected function gDefinition()
    {
        return manifest()->historicalStat($this->statId);
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
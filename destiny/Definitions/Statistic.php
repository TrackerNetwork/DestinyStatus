<?php

namespace Destiny\Definitions;

use Destiny\Definitions\Manifest\HistoricalStat;
use Illuminate\Support\Arr;

/**
 * @property string         $statId
 * @property string         $statName
 * @property mixed          $value
 * @property string         $displayValue
 * @property string         $formattedValue
 * @property HistoricalStat $definition
 */
class Statistic extends Definition
{
    protected function gDefinition()
    {
        return app('destiny.manifest')->historicalStat($this->statId);
    }

    protected function gStatName()
    {
        return $this->definition->statName;
    }

    protected function gValue()
    {
        return Arr::get($this->properties, 'basic.value');
    }

    protected function gDisplayValue()
    {
        return Arr::get($this->properties, 'basic.displayValue');
    }

    protected function gFormattedValue()
    {
        return number_format(Arr::get($this->properties, 'basic.value'));
    }
}

<?php

namespace Destiny\Definitions;

/**
 * @property string $progressionHash
 */
class Progression extends Definition
{
    protected function gProgressionHash($value)
    {
        return (string) $value;
    }
}

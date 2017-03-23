<?php

namespace Destiny\Definitions;

/**
 * @property string $destinationHash
 * @property string $destinationName
 * @property string $destinationDescription
 * @property string $destinationIdentifier
 * @property string $placeHash
 * @property string $icon
 * @property \Destiny\Definitions\Place $place
 */
class Destination extends Definition
{
    protected function gPlace()
    {
        return manifest()->place($this->placeHash);
    }
}

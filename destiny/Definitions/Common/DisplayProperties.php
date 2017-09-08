<?php

namespace Destiny\Definitions\Common;

use Destiny\Definitions\Definition;

/**
 * Class DisplayProperties.
 *
 * @property string $description
 * @property string $name
 * @property string $icon
 * @property bool $hasIcon
 */
class DisplayProperties extends Definition
{
    protected function gIcon()
    {
        if ($this->hasIcon) {
            return $this->getNonMutatedProperty('icon');
        }

        return '/img/misc/missing_icon.png';
    }
}

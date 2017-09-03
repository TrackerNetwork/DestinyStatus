<?php

namespace Destiny\Definitions\Progression;

use Destiny\Definitions\Definition;

/**
 * Class Quest.
 *
 * @property string $questHash
 * @property string $stepHash
 * @property array $stepObjectives
 * @property bool $tracked
 * @property string $itemInstanceId
 * @property bool $completed
 * @property bool $redeemed
 * @property bool $started
 * @property string $vendorHash
 */
class Quest extends Definition
{
    protected $appends = [
    ];
}

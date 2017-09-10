<?php

namespace Destiny\Definitions\Progression;

use Destiny\Definitions\Definition;

/**
 * Class Status.
 *
 * @property string $questHash
 * @property int $stepHash
 * @property array $stepObjectives
 * @property bool $tracked
 * @property string $itemInstanceId
 * @property bool $completed
 * @property bool $redeemed
 * @property bool $started
 */
class Status extends Definition
{
    protected $appends = [
    ];
}

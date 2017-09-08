<?php

declare(strict_types=1);

namespace Destiny\Milestones;

use Destiny\Definitions\Manifest\Activity;
use Destiny\Model;

/**
 * Class MilestoneActivity.
 *
 * @property string $activityHash
 * @property array $modifierHashes
 * @property array $variants
 * @property-read Activity $definition
 */
class MilestoneActivity extends Model
{
    protected $appends = [
    ];

    protected function gDefinition()
    {
        return manifest()->activity((string) $this->activityHash);
    }
}

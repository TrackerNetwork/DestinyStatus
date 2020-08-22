<?php
/**
 * @var Destiny\Definitions\Progression\Milestone $milestone
 * @var string $activityHash
 * @var Destiny\Definitions\Components\Character $character
 */

use Destiny\Activity\ActivityStat;

/** @var ActivityStat $activityStat */
$activityStat = $character->activities->$activityHash;
$completions = $activityStat->stats;
?>

<div class="activity" data-activityhash="<?= $activityHash; ?>" data-hash="<?= $milestone->milestoneHash ?>" data-identifier="<?= $milestone->milestoneHash ?>" data-completed="@bool($milestone->isCompleted)">
    <div class="image">
        <img class="icon" src="@bungie($milestone->icon)">
    </div>
    <div class="activity-details">
        <div class="name">
            <?= e($milestone->name) ?>
            @if($milestone->isCompleted)<i class="fa fa-check"></i>@endif
        </div>
        <div class="level">
            <span class="label">
            @if ($milestone->activityLevel > 0)
                Level <strong><?= ($milestone->activityLevel) ?></strong>
            @endif
            </span>
        </div>
        @if ($completions instanceof Destiny\StatisticsCollection)
            <div class="stats opaque">
                Completions:
                <strong>{{ $completions->activityCompletions->value }}</strong>
            </div>
        @endif
    </div>
</div>
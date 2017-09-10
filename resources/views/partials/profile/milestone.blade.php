<?php
/**
 * @var Destiny\Definitions\Progression\Milestone $milestone
 */
?>

<div class="activity" data-hash="<?= $milestone->milestoneHash ?>" data-identifier="<?= $milestone->milestoneHash ?>" data-completed="<?= bool($milestone->isCompleted) ?>">
    <div class="image">
        <img class="icon" src="<?= bungie($milestone->icon) ?>">
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
            @else
                Unknown
            @endif
            </span>
        </div>
        <div class="stats opaque">
            Completions:
            <strong>(soon)</strong>
        </div>
    </div>
</div>
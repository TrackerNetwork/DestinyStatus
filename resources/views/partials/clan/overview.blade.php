<?php
/** @var Destiny\Group $clan */
/** @var Destiny\Definitions\Milestone\RewardCategory $thisWeekRewards */

$progressions = $clan->progressions;
$thisWeekRewards = $clan->reward->thisWeekRewards;
$lastWeekRewards = $clan->reward->lastWeekRewards;
?>
@if (count($progressions) > 0)
    <h4>Progressions</h4>
    <div class="progressions panel">
        @foreach($progressions as $progression)
            @include('partials.profile.progression', ['progression' => $progression])
        @endforeach
    </div>
@else
    <br />
    <div class="alert alert-info">
        We don't have permission to view these factions. Please sign in or disable privacy settings.
    </div>
@endif
<div class="row">
    <div class="col-sm-6">
        <h5>This Week</h5>
        <div class="activities panel">
            <?php foreach($thisWeekRewards->rewards as $reward): ?>
                @include('partials.clan.checklist', ['reward' => $reward])
            <?php endforeach; ?>
        </div>
    </div>

    <div class="col-sm-6">
        <h5>Last Week</h5>
        <div class="activities panel">
            <?php foreach($lastWeekRewards->rewards as $reward): ?>
                @include('partials.clan.checklist', ['reward' => $reward])
            <?php endforeach; ?>
        </div>
    </div>
</div>


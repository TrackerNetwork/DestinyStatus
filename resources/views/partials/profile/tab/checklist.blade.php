<?php
/**
 * @var Destiny\Player $player
 * @var Destiny\Profile $profile
 * @var Destiny\Definitions\Components\Character $character
 * @var Destiny\Profile\Progression\MilestoneCollection $milestones
 */

?>
@if (count($milestones) > 0)
    <div class="panel-heading">Activities</div>
    <div class="activities panel">
        @foreach($milestones as $milestone)
            @include('partials.profile.milestone',  ['milestone' => $milestone])
        @endforeach
    </div>
    <div class="panel-heading">
        <?= duration_human(next_weekly()->diffInMinutes()) ?> until reset
    </div>
@else
    <br />
    <div class="alert alert-info">
        We don't have permission to view these milestones. Please sign in or disable privacy settings.
    </div>
@endif
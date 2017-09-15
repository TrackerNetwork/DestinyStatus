<?php
/**
 * @var Destiny\Player $player
 * @var Destiny\Profile $profile
 * @var Destiny\Definitions\Components\Character $character
 */

?>
@if (count($character->milestoneActivities) > 0)
    <div class="panel-heading">Activities</div>
    <div class="activities panel">
        @foreach($character->milestoneActivities as $milestone)
            @include('partials.profile.milestone',  ['milestone' => $milestone])
        @endforeach
    </div>
    <div class="panel-heading">Raids</div>
    <div class="activities panel">
        @foreach($character->milestoneRaids as $milestone)
            @include('partials.profile.milestone',  ['milestone' => $milestone])
        @endforeach
    </div>
    <div class="panel-heading">Clan</div>
    <div class="activities panel">
        @foreach($character->milestoneClan as $milestone)
            @include('partials.profile.milestone',  ['milestone' => $milestone])
        @endforeach
    </div>
    <div class="panel-heading">PVP</div>
    <div class="activities panel">
        @foreach($character->milestonePvp as $milestone)
            @include('partials.profile.milestone',  ['milestone' => $milestone])
        @endforeach
    </div>
    <div class="panel-heading">PVE</div>
    <div class="activities panel">
        @foreach($character->milestonePve as $milestone)
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
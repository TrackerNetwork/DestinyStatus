<?php
/**
 * @var Destiny\Player $player
 * @var Destiny\Profile $profile
 * @var Destiny\Definitions\Components\Character $character
 * @var Destiny\Profile\Progression\MilestoneCollection $milestones
 */

?>
<div class="panel-heading">
    @foreach($milestones as $milestone)
        @include('partials.profile.milestone',  ['milestone' => $milestone])
    @endforeach
    <?= duration_human(next_weekly()->diffInMinutes()) ?> until reset
</div>
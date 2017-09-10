<?php
/**
 * @var Destiny\Player $player
 * @var Destiny\Profile $profile
 * @var Destiny\Definitions\Components\Character $character
 * @var Destiny\Profile\Progression\ProgressionCollection $progressions
 */

?>
@if (count($progressions) > 0)
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

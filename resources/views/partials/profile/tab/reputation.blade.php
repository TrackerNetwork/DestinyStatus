<?php
/**
 * @var Destiny\Player $player
 * @var Destiny\Profile $profile
 * @var Destiny\Definitions\Components\Character $character
 * @var Destiny\Profile\Progression\ProgressionCollection $progressions
 */

?>
<div class="progressions panel">
    @foreach($progressions as $progression)
        @include('partials.profile.progression', ['progression' => $progression])
    @endforeach
</div>
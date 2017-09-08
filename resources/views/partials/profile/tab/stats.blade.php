<?php
/**
 * @var Destiny\Player $player
 * @var Destiny\Profile $profile
 * @var Destiny\Definitions\Components\Character $character
 */

?>
<div class="time panel"
     <?php if($character->minutesPlayedThisSession): ?>
     title="Played <?= e($character->lastPlayed->diffForHumans()) ?> for <?= strip_tags(duration_human($character->minutesPlayedThisSession)) ?>" data-toggle="tooltip"
<?php endif; ?>
>
    <div class="info">Total Time Played (including Tower and Orbit)</div>
    @include('partials.profile.timespan', ['minutes' => $character->minutesPlayedTotal])

    <div class="info">Active Time Played (bugged)</div>
    @include('partials.profile.timespan', ['minutes' => $character->minutesPlayedActive])
</div>
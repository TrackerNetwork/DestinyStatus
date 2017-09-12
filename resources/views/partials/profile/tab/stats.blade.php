<?php
/**
 * @var Destiny\Player $player
 * @var Destiny\Profile $profile
 * @var Destiny\Definitions\Components\Character $character
 */

$pvp = $character->statsPvP;
$pve = $character->statsPvE;
$all = $character->statsAll;
?>
<div class="time panel"
     <?php if($character->minutesPlayedThisSession): ?>
     title="Played <?= e($character->lastPlayed->diffForHumans()) ?> for <?= strip_tags(duration_human($character->minutesPlayedThisSession)) ?>" data-toggle="tooltip"
<?php endif; ?>
>
    <div class="info">Total Time Played (including Tower and Orbit)</div>
    @include('partials.profile.timespan', ['minutes' => $character->minutesPlayedTotal])

    <div class="info">Active Time Played</div>
    @include('partials.profile.timespan', ['minutes' => $character->minutesPlayedActive])
</div>
<div class="stats panel">
    @include('partials.profile.stats.pvp', ['pvp' => $pvp, 'key' => 'stats-pvp-'.$character->characterId])
</div>
<div class="stats panel">
    @include('partials.profile.stats.pve', ['pve' => $pve, 'key' => 'stats-pve-'.$character->characterId])
</div>
<div class="stats panel">
    @include('partials.profile.stats.total', ['pve' => $pve, 'pvp' => $pvp, 'key' => 'stats-total-'.$character->characterId])
</div>
<div class="stats panel">
    @include('partials.profile.stats.ability', ['pve' => $pve, 'pvp' => $pvp, 'key' => 'stats-ability-'.$character->characterId])
</div>
<div class="stats panel">
    @include('partials.profile.stats.primary', ['pve' => $pve, 'pvp' => $pvp, 'key' => 'stats-primary-'.$character->characterId])
</div>
<div class="stats panel">
    @include('partials.profile.stats.power', ['pve' => $pve, 'pvp' => $pvp, 'key' => 'stats-power-'.$character->characterId])
</div>
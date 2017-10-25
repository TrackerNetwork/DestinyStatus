<?php
/**
 * @var Destiny\Player $player;
 * @var \App\Account $account
 */
?>
<div class="statistics row">
    <div class="col-sm-12">
        <h3>Destiny 1 Stats&nbsp;<small>(<a target="_blank" href="https://d1.destinystatus.com/<?= $player->platform; ?>/<?= $account->name; ?>">view full stats</a>)</small></h3>
    </div>
    <div class="col-sm-3">
        @include('partials.stats.stats', ['icon' => 'fa-trophy', 'header' => 'PvP & PvE', 'stats' => [
        [
            'name' => 'Grimoire',
            'value' => $account->stats->grimoire
        ]]])
    </div>
    <div class="col-sm-3">
        @include('partials.stats.stats', ['icon' => 'fa-trophy', 'header' => 'PvE', 'stats' => [
        [
            'name' => 'Raid Clears',
            'value' => $account->stats->raid_completions
        ]]])
    </div>
    <div class="col-sm-3">
        @include('partials.stats.stats', ['icon' => 'fa-bullseye', 'header' => 'PvP', 'stats' => [
        [
            'name' => 'KD Ratio',
            'value' => $account->stats->kd . ' ('.$account->stats->total_games . ' games)'
        ]]])
    </div>
    <div class="col-sm-3">
        <div class="stats panel">
            <div class="time panel">
                <div class="info">Time Played</div>
                @include('partials.duration', ['minutes' => $account->stats->playtime / 60])
            </div>
        </div>
    </div>
</div>
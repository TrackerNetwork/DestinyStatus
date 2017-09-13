<?php
/** @var Destiny\LeaderboardCollection $stats */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel">
            All these stats are from clan members in only PvE activities.
        </div>
    </div>
</div>
<div class="stats row">
    <div class="col-sm-4">
        <div class="stats panel">
            @include('partials.clan.leaderboard', ['category' => $stats->lbSingleGameKills])
        </div>
    </div>
    <div class="col-sm-4">
        <div class="stats panel">
            @include('partials.clan.leaderboard', ['category' => $stats->lbLongestKillSpree])
        </div>
    </div>
    <div class="col-sm-4">
        <div class="stats panel">
            @include('partials.clan.leaderboard', ['category' => $stats->lbLongestSingleLife])
        </div>
    </div>
</div>
<div class="stats row">
    <div class="col-sm-4">
        <div class="stats panel">
            @include('partials.clan.leaderboard', ['category' => $stats->lbKills])
        </div>
    </div>
    <div class="col-sm-4">
        <div class="stats panel">
            @include('partials.clan.leaderboard', ['category' => $stats->lbObjectivesCompleted])
        </div>
    </div>
    <div class="col-sm-4">
        <div class="stats panel">
            @include('partials.clan.leaderboard', ['category' => $stats->lbDeaths])
        </div>
    </div>
</div>
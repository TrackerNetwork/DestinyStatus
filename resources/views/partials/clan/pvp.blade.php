<?php
/** @var Destiny\LeaderboardCollection $stats */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel">
            All these stats are from clan members in only PvP activities.
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
            @include('partials.clan.leaderboard', ['category' => $stats->lbSingleGameScore])
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
            @include('partials.clan.leaderboard', ['category' => $stats->lbDeaths])
        </div>
    </div>
    <div class="col-sm-4">
        @include('vendor.ad_box')
    </div>
</div>
<div class="stats row">
    <div class="col-sm-4">
        <div class="stats panel">
            @include('partials.clan.leaderboard', ['category' => $stats->getKd()])
        </div>
    </div>
    <div class="col-sm-4">
        <div class="stats panel">
            @include('partials.clan.leaderboard', ['category' => $stats->getKad()])
        </div>
    </div>
    <div class="col-sm-4">
        <div class="stats panel">
            @include('partials.clan.leaderboard', ['category' => $stats->lbLongestSingleLife])
        </div>
    </div>
</div>
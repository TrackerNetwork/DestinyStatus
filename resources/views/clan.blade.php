<?php
/**
 * @var Destiny\Player $player
 * @var Destiny\Group $group
 */
?>

@extends('layout')
@section('title', $group->name)

@section('content')
    @include('partials.profile.clan', ['player' => $player, 'tab' => 'account', 'group' => $group])
    <div class="arenas row">
        <div class="col-md-12 arena">
            <div class="display" data-toggle="popover" title="<?= e($group->name) ?>" data-content="<?= e($group->about) ?>">
                <img class="background" src="<?= bungie($group->bannerPath) ?>" />
                <img class="icon" src="<?= bungie($group->avatarPath) ?>" alt="" align="left" />
                <h3>
                    <div class="pull-left">
                        <?= e($group->name) ?>
                        <small><?= e($group->memberCount).' clan members.' ?></small>
                    </div>
                    <span class="pull-right">
                        <?= e($group->callsign); ?>
                        <small>Created on <?= e($group->created->toFormattedDateString()); ?></small>
                    </span>
                </h3>
            </div>
            <div role="tabpanel">
                <ul class="nav nav-pills nav-justified" role="tablist">
                    <li class="active"><a href="#overview" role="tab" data-toggle="tab" data-group="<?= $group->groupId ?>">Overview</a></li>
                    <li class=""><a href="#leaderboard-pvp" role="tab" data-toggle="tab" data-group="<?= $group->groupId ?>">PvP</a></li>
                    <li class=""><a href="#leaderboard-pve" role="tab" data-toggle="tab" data-group="<?= $group->groupId ?>">PvE</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active character" role="tabpanel" id="overview">
                    @include('partials.clan.overview', ['clan' => $group])
                </div>
                <div class="tab-pane" role="tabpanel" id="leaderboard-pvp">
                    <?php if (empty($group->leaderboards->allPvP)): ?>
                        <br />
                        <div class="alert alert-warning">
                            Leaderboards empty and/or could not be loaded.
                        </div>
                    <?php else: ?>
                        @include('partials.clan.pvp', ['stats' => $group->leaderboards->allPvP])
                    <?php endif; ?>
                </div>
                <div class="tab-pane" role="tabpanel" id="leaderboard-pve">
                    <?php if (empty($group->leaderboards->allPvE)): ?>
                        <br />
                        <div class="alert alert-warning">
                            Leaderboards empty and/or could not be loaded.
                        </div>
                    <?php else: ?>
                        @include('partials.clan.pve', ['stats' => $group->leaderboards->allPvE])
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
@stop

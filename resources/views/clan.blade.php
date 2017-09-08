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
                    <?= e($group->name) ?>
                    <small><?= e($group->memberCount).' clan members.' ?></small>
                </h3>
            </div>
            <div class="panel">
                <i>This area is under construction. Soon to hold clan leaderboards, stats towards weekly progress and more.</i>
            </div>
        </div>
    </div>
@stop

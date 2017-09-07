<?php
/**
 * @var Destiny\Player $player
 * @var App\Account $account
 * @var Destiny\Profile $profile
 */
?>

@extends('layout')
@section('title', $player->displayName)

@section('content')
    @include('partials.profile.player', ['player' => $player, 'account' => $account, 'tab' => 'account'])
    <div class="characters row">

    <?php $i = 0; foreach($profile->characters as $character): $i++; ?>
        @include('partials.character', ['character' => $character, 'profile' => $profile, 'i' => $i, 'player' => $player])
    <?php endforeach; ?>

    </div>

    @if ($account->stats)
        @include('partials.d1_stats', ['account' => $account, 'player' => $player])
    @endif
@stop
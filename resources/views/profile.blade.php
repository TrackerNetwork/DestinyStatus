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
    <br />
    <div class="characters row">

    <?php $i = 0; foreach($profile->characters as $character): $i++; ?>
        <div class="character col-sm-4"
             data-membership-type="<?= $player->membershipType ?>"
             data-membership-id="<?= $player->membershipId ?>"
             data-character-id="<?= $character->characterId ?>"
        >
            @include('partials.profile.plate', ['character' => $character])
        </div>
    <?php endforeach; ?>

    </div>

    @if ($account->stats)
        @include('partials.d1_stats', ['account' => $account, 'player' => $player])
    @endif
@stop
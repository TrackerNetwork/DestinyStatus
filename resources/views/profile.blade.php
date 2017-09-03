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
    <pre>
    </pre>
@stop
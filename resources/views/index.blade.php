<?php
/** @var Destiny\Milestones\MilestoneHandler $milestoneHandler */
?>

@extends('layout')
@section('content')
    <div class="alert alert-info">
        The website <a target="_blank" href="https://github.com/Bungie-net/api/wiki/2.3.0-and-2.3.1-Changes-(Forsaken-Release)#breaking-changes">will be degraded</a> until 9/4 with Destiny2 release v2.3.1
    </div>
    <h2>Weekly Milestones</h2>
    @include('partials.homepage.weekly', ['milestones' => $milestoneHandler->weeklys])

    <h2>Time till Weekly Reset</h2>
    <Countdown weekly="<?= next_weekly()->toRfc2822String(); ?>"></Countdown>
@stop
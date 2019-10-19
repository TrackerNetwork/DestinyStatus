<?php
/** @var Destiny\Milestones\MilestoneHandler $milestoneHandler */
?>

@extends('layout')
@section('content')
    <h2>Weekly Milestones</h2>
    @include('partials.homepage.weekly', ['milestones' => $milestoneHandler->weeklys])

    <h2>Time till Weekly Reset</h2>
    <Countdown weekly="<?= next_weekly()->format('F d, Y'); ?>"></Countdown>
@stop
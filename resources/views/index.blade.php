<?php
/** @var Destiny\Milestones\MilestoneHandler $milestoneHandler */
?>

@extends('layout')
@section('content')
    <h2>Weekly Milestones</h2>
    @include('partials.homepage.weekly', ['milestones' => $milestoneHandler->weeklys])
@stop
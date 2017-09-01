@extends('layout')

@section('content')
<?php
/**
* @var App\Models\Bungie $bungie
*/
?>
    <h1><?= $bungie->display_name ?> <small>Select preferred account</small></h1>
    <?php foreach($bungie->accounts as $account): ?>
        <a class="select-player" href="<?= route('switch', ['id' => $account->id]); ?>"><img src="<?= $account->platformImage() ?>">&nbsp;<?= e($account->name) ?></a>
    <?php endforeach; ?>
@stop
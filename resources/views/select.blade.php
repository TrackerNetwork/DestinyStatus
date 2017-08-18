@extends('layout')

@section('content')
    <?php
    /**
     * @var string $gamertag
     * @var \Destiny\Player $player
     */
    ?>
    <h1><?= $gamertag ?> <small>Select platform</small></h1>
    @foreach($players as $player)
        <a class="select-player" href="<?= $player->url ?>"><img src="<?= $player->platformIcon ?>"><?= e($player->platformName) ?></a>
    @endforeach
@stop
@extends('layout')
@section('content')
<?php
/**
* @var string $gamertag
* @var \destiny\Player $player
*/
?>
@if ($result->isEmpty())
    <div class="empty-result">
        Sorry. The gamertag <strong><?= e($gamertag) ?></strong> could not be found.
    </div>
@else
    <h4>Search results for "<?= e($gamertag) ?>"</h4>
    <div class="row">
        @foreach($result as $player)
            <div class="panel col-md-4">
                <a href="<?= $player->url ?>">
                    <img src="<?= bungie($player->iconPath) ?>">
                    <span><?= e($player->displayName) ?></span>
                </a>
            </div>
        @endforeach
    </div>
@endif
@stop
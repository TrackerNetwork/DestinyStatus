@extends('layout')
@section('content')
<?php
/**
* @var string $gamertag
* @var \Destiny\Player $player
* @var \Destiny\PlayerCollection $result
*/
?>
@if ($result->isEmpty())
    <div class="empty-result">
        Sorry. The gamertag <strong><?= e($gamertag) ?></strong> could not be found.
    </div>
@else
    <h4>Search results for "<?= e($gamertag) ?>"</h4>
    <div class="row">
        <?php $i = 0; foreach($result as $player): ?>
            <div class="panel col-md-4">
                <a href="<?= $player->url ?>">
                    <img src="@bungie($player->iconPath)">
                    <span><?= e($player->displayName) ?></span>
                </a>
            </div>
        <?php endforeach; ?>
        <?php if ($i == 2): ?>
            @include('vendor.ad_box')
        <?php endif; ?>
    </div>
@endif
@stop
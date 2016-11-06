@extends('layout')
@section('title', 'Exotic Weapon Quests for '.$player->displayName)
@section('content')
@include('block/player', ['player' => $player, 'tab' => 'exotics'])
<?php
/**
 * @var \Destiny\Grimoire $grimoire
 * @var \Destiny\Exotics $exotics
 */
?>

<div class="exotics-index row">
    <?php $i = 0; foreach ($exotics['weapons'] as $exotic): ?>
        <div class="card <?= $exotic['weapon']->active ? 'active' : '' ?> col-md-4 <?= ($i % 3 == 0) ? 'first' : ''; ?>">
            <div class="panel">
                <div class="title">
                    <div class="images">
                        <?= $exotic['weapon']->thumbnail ?>
                        <?= $exotic['weapon']->page->thumbnail ?>
                        <?= $exotic['weapon']->theme->thumbnail ?>
                    </div>
                    <div class="title" data-completed="<?= $exotic['weapon']->active ? "true" : "false"; ?>">
                        <h3 class="name">
                            <a class="name" href="<?= dtrgrimoire($exotic['weapon']) ?>" target="_blank"><?= e($exotic['name']) ?></a>
                            <?php if ($exotic['weapon']->active): ?>
                                <i class="fa fa-check"></i>
                            <?php endif; ?>
                        </h3>
                    </div>
                    <p>
                        <?= $exotic['hint']; ?>
                    </p>
                </div>
            </div>
        </div>
    <?php $i++; endforeach; ?>
</div>
@stop

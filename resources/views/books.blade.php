@extends('layout')
@section('title', 'Record Books for '.$player->displayName)
@section('content')
    @include('block/player', ['player' => $player, 'tab' => 'books'])
	<?php
	/**
	 * @var \Destiny\Character\RecordBookCollection $books
     * @var \Destiny\Definitions\RecordBook $book
	 */
	?>

    <div class="recordbooks-index activities row">
        <?php foreach ($books as $book): ?>
        <div class="row">
            <img style="width: 125px;" src="<?= bungie($book->icon); ?>" class="img-rounded" />

            <div role="tabpanel" class="rewards levels">
                <ul class="nav nav-pills" role="tablist">
                    <?php $i = 1; foreach ($book->pages as $page): ?>
                        <li class="<?= $i === 1 ? 'active' : null; ?>"><a href="#pages-<?= $i; ?>" role="tab" data-toggle="tab">Page <?= $i; ?></a></li>
                    <?php $i++; endforeach; ?>
                </ul>
            </div>

        </div>
        <?php endforeach; ?>
    </div>
@stop

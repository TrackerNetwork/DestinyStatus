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

    <div class="recordbooks-index arenas row">
        <br />
        <?php foreach ($books as $book): ?>
        <div class="arena row">
            <div class="col-md-2 col-xs-12 center-block">
                <img style="width: 125px;" src="<?= bungie($book->icon); ?>" class="img-rounded" />
                <h2><?= $book->displayName; ?></h2>
                <h4><?= $book->displayDescription; ?></h4>
            </div>
            <div class="col-md-10 col-xs-12">
                <div role="tabpanel" class="rewards levels">
                    <ul class="nav nav-pills" role="tablist">
						<?php $i = 1; foreach ($book->pages as $page): ?>
                            <li class="<?= $i === 1 ? 'active' : null; ?>"><a href="#pages-<?= $i . "-" . $book->hash ?>" role="tab" data-toggle="tab">Page <?= $i; ?></a></li>
						<?php $i++; endforeach; ?>
                    </ul>
                </div>
                <div class="tab-content">
					<?php $i = 1; foreach ($book->pages as $page): ?>
                    <div class="book-page tab-pane <?= $i === 1 ? 'active' : null; ?>" role="tabpanel" id="pages-<?= $i . "-" . $book->hash ?>">
                        <h4><?= $page['displayName']; ?></h4>
                        <?php if (count($page['records']) > 0): ?>
                            <div class="rounds">
								<?php foreach ($page['records'] as $record): ?>
								    <div class="round" data-completed="<?= $record['status'] == 2 ? 1 : 0; ?>">
                                        <div class="info">
                                            <div class="round-number">
                                                <?php if ($record['status'] == 2): ?>
                                                    <i class="fa fa-check"></i>
                                                <?php endif; ?>
                                                <?= $record['displayName']; ?>
                                            </div>
                                            <div class="enemy">
                                                <?= $record['description']; ?>
                                                <?php if ($record['status'] !== 2): ?>
                                                    @include('block/progress', ['progress' => $record['percent'], 'label' => $record['objective']['displayDescription']])
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div class="rounds">
                                <?php foreach ($page['rewards'] as $reward): ?>
                                    <?php if (isset($reward['icon'])): ?>
                                        <div class="round">
                                            <div class="round-number">Unlocked at Book Level <?= $reward['requirementProgressionLevel']; ?></div>
                                            <div class="enemy">
												<?= $reward['itemName']; ?> x <?= $reward['quantity']; ?>
                                            </div>
                                            <div class="skulls">
                                                <div class="skull">
                                                    <img src="<?= bungie($reward['icon']); ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
					<?php $i++; endforeach; ?>
                </div>
            </div>
        </div>
        <br />
        <?php endforeach; ?>
    </div>
@stop

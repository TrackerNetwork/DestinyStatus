@extends('layout')
@section('title', 'Grimoire for '.$player->displayName)
@section('content')
@include('block/player', ['player' => $player, 'tab' => 'grimoire'])
<?php
/**
 * @var \Destiny\Grimoire $grimoire
 */
?>

<h1 class="grimoire"><?= $grimoire->score ?><span class="total"> / <?= $grimoire->points ?></span></h1>

<div class="grimoire-index row">
<?php $i = 0; foreach ($grimoire->cardsIncomplete as $card): ?>
	<div
		class="card <?= $card->active ? 'active' : '' ?> col-md-4 <?= ($i % 3 == 0) ? 'first' : ''; ?>"
		data-card-id="<?= $card->cardId ?>">

		<div class="panel">

			<div class="title">
				<div class="images">
					<?= $card->thumbnail ?>
					<?= $card->page->thumbnail ?>
					<?= $card->theme->thumbnail ?>
				</div>
				<div class="grimoire"><?= $card->score ?><span class="total"> / <?= $card->totalPoints ?></span></div>
				<h3 class="name"><a href="<?= dtrgrimoire($card) ?>" target="_blank"><?= e($card->cardName) ?></a></h3>
			</div>

			<?php if($card->hasStats()): ?>
			<div class="data">
				<div class="stats">
					<?php foreach ($card->statisticCollection as $statistic): ?>
						<div class="stat">
							<h4>
								<?= e($statistic->statName) ?>
								<span class="label"><?= e($statistic->displayValue) ?></span>
							</h4>

							<?php if($statistic->hasRanks()): ?>
							<div class="ranks">
							<?php foreach ($statistic->rankCollection as $rank): ?>
								<div class="rank col-md-4 col-sm-4 col-xs-4 <?= ($rank->completed ? 'complete' : '') ?>">
									@include('block/progress', ['progress' => $rank->percentDisplay, 'label' => $rank->percentLabel])
								</div>
							<?php endforeach; ?>
							</div>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<?php endif; ?>

			<?php if( ! $card->isObtainable()): ?>
			<div class="unobtainable opaque"><i class="fa fa-exclamation-circle"></i> This card is unobtainable</div>
			<?php endif; ?>

			<?php if($card->isPlaystationExclusive()): ?>
			<div class="exclusive opaque"><i class="fa fa-info-circle"></i> PlayStation Exclusive</div>
			<?php endif; ?>

			<?php if($card->isBugged()): ?>
			<div class="bugged opaque"><i class="fa fa-question-circle"></i> This card is bugged</div>
			<?php endif; ?>
		</div>
	</div>
<?php $i++; endforeach; ?>
</div>

@stop

<?php
/**
 * @var \Destiny\Player $player
 * @var \Destiny\Account $account
 */

#de($player->account->characters->first()->toArray());
#de($player->account->characters->last()->statistics);
#de($player->account->characters->first()->activities->weekly);
#dd($player->account->characters->last()->inventory->currencies);
#de($player->account->characters->first()->inventory->buckets);
#dd($player->account->characters->last()->inventory->primaryWeapons->equipped->damage);
#dd($player->account->characters->last()->inventory->head->equipped->toArray());
#dd($player->account->characters->first()->activities->dateActivityStarted);
?>
@extends('layout')
@section('title', $player->displayName)
@section('content')
@include('block/player', ['player' => $player, 'tab' => 'account'])

<div class="characters row">

	<?php $i = 0; foreach($account->characters as $character): $i++; ?>

	<?php
		$inventory = $character->inventory;
		$progression = $character->progression;
	?>

	<div class="character col-sm-4"
		data-membership-type="<?= $player->membershipType ?>"
		data-membership-id="<?= $player->membershipId ?>"
		data-character-id="<?= $character->characterId ?>"
		>

		@include('block/plate', ['character' => $character])

		<div role="tabpanel">
			<ul class="nav nav-pills nav-justified" role="tablist">
				<li class="active"><a href="#inventory-<?=$i?>" role="tab" data-toggle="tab" data-group="<?=$i?>">Items</a></li>
				<li><a href="#progressions-<?=$i?>" role="tab" data-toggle="tab" data-group="<?=$i?>">Reputation</a></li>
				<li><a href="#weekly-<?=$i?>" role="tab" data-toggle="tab" data-group="<?=$i?>">Weekly</a></li>
				<li><a href="#stats-<?=$i?>" role="tab" data-toggle="tab" data-group="<?=$i?>">Stats</a></li>
			</ul>

			<div class="tab-content">
				<div class="inventory tab-pane active" role="tabpanel" id="inventory-<?=$i?>">
					<div class="equipment panel">
						@include('block/bucket', ['bucket' => $inventory->subclass])
						@include('block/bucket', ['bucket' => $inventory->primaryWeapons])
						@include('block/bucket', ['bucket' => $inventory->specialWeapons])
						@include('block/bucket', ['bucket' => $inventory->heavyWeapons])
						@include('block/bucket', ['bucket' => $inventory->ghost])
					</div>
					<div class="equipment panel">
						@include('block/bucket', ['bucket' => $inventory->head])
						@include('block/bucket', ['bucket' => $inventory->arms])
						@include('block/bucket', ['bucket' => $inventory->chest])
						@include('block/bucket', ['bucket' => $inventory->legs])
						@include('block/bucket', ['bucket' => $inventory->class])
						@include('block/bucket', ['bucket' => $inventory->artifact])
					</div>
					<div class="equipment panel">
						@include('block/bucket', ['bucket' => $inventory->shader])
						@include('block/bucket', ['bucket' => $inventory->emblem])
						@include('block/bucket', ['bucket' => $inventory->vehicle])
						@include('block/bucket', ['bucket' => $inventory->ship])
						@include('block/bucket', ['bucket' => $inventory->emote])
					</div>
				</div>

				<div class="tab-pane" role="tabpanel" id="progressions-<?=$i?>">
					<div class="progressions panel">
						@include('block/progression', ['progression' => $character->progression->cryptarch])
						@include('block/progression', ['progression' => $character->progression->gunsmith])
						@include('block/progression', ['progression' => $character->progression->vanguard])
						@include('block/progression', ['progression' => $character->progression->crucible])
						@include('block/progression', ['progression' => $character->progression->deadOrbit])
						@include('block/progression', ['progression' => $character->progression->newMonarchy])
						@include('block/progression', ['progression' => $character->progression->futureWarCult])
						@include('block/progression', ['progression' => $character->progression->ironBanner])
						@include('block/progression', ['progression' => $character->progression->erisMorn])
						@include('block/progression', ['progression' => $character->progression->queen])
						@include('block/progression', ['progression' => $character->progression->houseOfJudgment])
                        @include('block/progression', ['progression' => $character->progression->srl])
						{{--
						@foreach($character->progression as $progression)
						@include('block/progression', ['progression' => $progression])
						@endforeach
						--}}
					</div>
				</div>

				<div class="tab-pane" role="tabpanel" id="weekly-<?=$i?>">

					<div class="panel-heading">
						<?= duration_human(next_weekly()->diffInMinutes()) ?> until reset
					</div>

					<?php /*
					<div class="progressions panel">
						@include('block/weekly', ['progression' => $character->progression->weeklyVanguard])
						@include('block/weekly', ['progression' => $character->progression->weeklyCrucible])
					</div> */ ?>

					@if(count($character->weeklyRaids))
					<div class="panel-heading">Raids</div>
					<div class="activities panel">
						@foreach($character->weeklyRaids as $activity)
							@include('block/activity', ['activity' => $activity])
						@endforeach
					</div>
					@endif

					@if(count($character->weeklyArenas))
					<div class="panel-heading">Arenas</div>
					<div class="activities panel">
						@foreach($character->weeklyArenas as $activity)
							@include('block/activity', ['activity' => $activity])
						@endforeach
					</div>
					@endif
				</div>

				<div class="statistics tab-pane" role="tabpanel" id="stats-<?=$i?>">
					<div class="time panel"
						<?php if($character->minutesPlayedThisSession): ?>
						title="Played <?= e($character->dateLastPlayed->diffForHumans()) ?> for <?= strip_tags(duration_human($character->minutesPlayedThisSession)) ?>" data-toggle="tooltip"
						<?php endif; ?>
						>
						<div class="info">Total Time Played (including Tower and Orbit)</div>
						@include('block/timespan', ['minutes' => $character->minutesPlayedTotal])

						<div class="info">Active Time Played</div>
						@include('block/timespan', ['minutes' => $character->minutesPlayedActive])
					</div>

					@include('block/stats', ['stats' => $character->statistics])
				</div>
			</div>

		</div>
	</div>

	<?php endforeach; ?>

</div>

	<?php /*
<a class="character"
	href="<?=route('character', ['player' => $player->displayName, 'character' => $character->characterId])?>"
	data-light="<?=bool($character->isPrestigeLevel)?>"
	style="background-image: url("<?=img($character->backgroundPath)?>");">

	<div class="emblem" style="background-image: url(<?=img($character->emblemPath)?>);"></div>
	<div class="details">
		<div class="name">Name: <?=e($player->displayName)?></div>
		<div class="clan">Clan: <?=e($player->account->clan)?></div>
		<div class="class">Class: <?=e($character->class)?></div>
		<div class="race">Race: <?=e($character->raceGender)?></div>
		<div class="level"><?=e($character->powerLevel)?></div>
		<div class="grimoire"><?=e($character->grimoireScore)?></div>
	</div>

	<div class="currencies">
	<?php foreach ($character->currencies as $currency): ?>
		<img src="<?= img($currency->icon) ?>" alt=""> <?= $currency->value ?>
	<?php endforeach; ?>
	</div>

	<div class="characterProgress">
		<div class="barFill" style="width: 0px;" data-width="86.00006%"></div>
	</div>
</a>

<?php endforeach;*/ ?>

@stop

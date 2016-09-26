<?php
/**
 * @var \Destiny\Player $player
 * @var \Destiny\Account $account
 */
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
				<li><a href="#weekly-<?=$i?>" role="tab" data-toggle="tab" data-group="<?=$i?>">Checklist</a></li>
				<li><a href="#stats-<?=$i?>" role="tab" data-toggle="tab" data-group="<?=$i?>">Stats</a></li>
			</ul>

			<div class="tab-content">
				<div class="inventory tab-pane active" role="tabpanel" id="inventory-<?=$i?>">
					<div class="equipment panel">
						@include('block/bucket', ['item' => $inventory->subclass])
						@include('block/bucket', ['item' => $inventory->primaryWeapons])
						@include('block/bucket', ['item' => $inventory->specialWeapons])
						@include('block/bucket', ['item' => $inventory->heavyWeapons])
						@include('block/bucket', ['item' => $inventory->ghost])
					</div>
					<div class="equipment panel">
						@include('block/bucket', ['item' => $inventory->head])
						@include('block/bucket', ['item' => $inventory->arms])
						@include('block/bucket', ['item' => $inventory->chest])
						@include('block/bucket', ['item' => $inventory->legs])
						@include('block/bucket', ['item' => $inventory->class])
						@include('block/bucket', ['item' => $inventory->artifact])
					</div>
					<div class="equipment panel">
						@include('block/bucket', ['item' => $inventory->shader])
						@include('block/bucket', ['item' => $inventory->emblem])
						@include('block/bucket', ['item' => $inventory->vehicle])
						@include('block/bucket', ['item' => $inventory->sparrowHorn])
						@include('block/bucket', ['item' => $inventory->ship])
						@include('block/bucket', ['item' => $inventory->emote])
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
					</div>
				</div>

				<div class="tab-pane" role="tabpanel" id="weekly-<?=$i?>">

					<div class="panel-heading">
						<?= duration_human(next_weekly()->diffInMinutes()) ?> until reset
					</div>

					@if (count($character->dailyAndNightfall))
						<div class="panel-heading">Activities</div>
						<div class="activities panel">
							@foreach($character->dailyAndNightfall as $activity)
								@include('block/activity', ['activity' => $activity])
							@endforeach
						</div>
					@endif
					@if (count($character->weeklyRaids))
						<div class="panel-heading">Raids</div>
						<div class="activities panel">
							@foreach($character->weeklyRaids as $activity)
								@include('block/activity', ['activity' => $activity])
							@endforeach
						</div>
					@endif

					@if (count($character->weeklyArenas))
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
		@if ($i === 2 && ! \App::isLocal())
			<div class="col-md-4">
				<div style="margin-top:50px;">
					<div class="ad-tag" data-ad-name="300x250_#1" data-ad-size="300x250" ></div>
					<script src="//tags-cdn.deployads.com/a/destinystatus.com.js " async ></script>
					<script>(deployads = window.deployads || []).push({});</script>
				</div>
			</div>
		@endif
	</div>
	<?php endforeach; ?>
</div>
@stop

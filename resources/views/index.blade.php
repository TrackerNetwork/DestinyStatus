@extends('layout')
@section('content')
	<?php
	/**
	 * @var \Destiny\Advisors $advisors
	 * @var $event \Destiny\AdvisorsTwo\Activity
	 * @var array $news
	 * @var array $entry
	 */
	?>
	<?php if ($advisors->eventsExist()): ?>
	<h3>Current events</h3>
	<div class="events row">
		<?php foreach($advisors->activeEvents as $event): ?>
			<div class="col-md-4">@include('block/event', ['activity' => $event])</div>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>
	<div role="tabpanel">
		<ul class="nav nav-pills nav-justified" role="tablist">
			<li class="active"><a href="#pve" role="tab" data-toggle="tab" data-group="home">PVE</a></li>
			<li><a href="#pvp" role="tab" data-toggle="tab" data-group="home">PVP</a></li>
			<li><a href="#arena" role="tab" data-toggle="tab" data-group="home">Arena</a></li>
			<?php if ($advisors->hasBlockEvents()): ?>
				<li><a href="#events" role="tab" data-toggle="tab" data-group="home">Events</a></li>
			<?php endif; ?>
		</ul>
		<div class="tab-content">
			<div class="pve tab-pane active" role="tabpanel" id="pve">
				<div class="activities row">
					<div class="col-md-4">
						<h3>Daily Story Mission</h3>
						@include('block/advisor', ['activity' => $advisors->dailychapter])
					</div>
					<div class="col-md-4">
						<h3>Nightfall Strike</h3>
						@include('block/advisor', ['activity' => $advisors->nightfall])
					</div>
					<div class="col-md-4">
						<h3>Weekly Heroic Strikes</h3>
						@include('block/advisor', ['activity' => $advisors->heroicstrike])
					</div>
				</div>
				<h3>Raids</h3>
				<div class="arenas row">
					<div class="col-md-4 arena">
						@include('block/raid', ['activity' => $advisors->wrathofthemachine])
					</div>
					<div class="col-md-4 arena">
						@include('block/raid', ['activity' => $advisors->kingsfall])
					</div>
					<div class="col-md-4 arena">
						@include('block/raid', ['activity' => $advisors->crota])
					</div>
					<div class="col-md-4 arena">
						@include('block/raid', ['activity' => $advisors->vaultofglass])
					</div>
				</div>
			</div>
			<div class="pvp tab-pane" role="tabpanel" id="pvp">
				<div class="activities row">
					<div class="col-md-4">
						<h3>Daily Crucible Playlist</h3>
						@include('block/advisor', ['activity' => $advisors->dailycrucible])
					</div>
					<div class="col-md-4">
						<h3>Weekly Crucible Playlist</h3>
						@include('block/advisor', ['activity' => $advisors->weeklycrucible])
					</div>
					@if (! App::isLocal())
						<div class="col-md-4">
							<div style="margin-top:50px;">
								<div class="ad-tag" data-ad-name="300x250_#1" data-ad-size="300x250" ></div>
								<script src="//tags-cdn.deployads.com/a/destinystatus.com.js " async ></script>
								<script>(deployads = window.deployads || []).push({});</script>
							</div>
						</div>
					@endif
				</div>
			</div>
			<div class="arena tab-pane" role="tabpanel" id="arena">
				<div class="arenas row">
					<?php foreach($advisors->elderchallenge->activityTiers as $arena): ?>
					<div class="col-md-4 arena" data-activity-hash="<?= $arena->activityHash ?>">
						<h3>Elder Challenge</h3>
						@include('block/arena', ['activity' => $advisors->elderchallenge, 'arena' => $arena, 'challenge' => true])
					</div>
					<?php endforeach; ?>
					<div class="col-md-4 arena" data-activity-hash="<?= $advisors->prisonofeldersplaylist->activityHash; ?>">
						<h3>Prison of Elders Playlist</h3>
						@include('block/advisor', ['activity' => $advisors->prisonofeldersplaylist])
					</div>
				</div>
				<h3>Prison Of Elders</h3>
				<div class="arenas row">
					<?php foreach($advisors->prisonofelders->activityTiers as $arena): ?>
					<div class="col-md-4 arena" data-activity-hash="<?= $arena->activityHash ?>">
						@include('block/arena', ['activity' => $advisors->prisonofelders, 'arena' => $arena, 'challenge' => false])
					</div>
					<?php endforeach; ?>
				</div>
			</div>
			<?php if ($advisors->hasBlockEvents()): ?>
				<div class="arena tab-pane" role="tabpanel" id="events">
					<div class="arenas row">
						<?php foreach($advisors->activeEvents as $event): ?>
							<?php if ($event instanceof \Destiny\AdvisorsTwo\Activity\EventInterface): ?>
								<div class="col-md-4 arena" data-identifier="<?= $event->identifier; ?>">
									<h3><?= $event->getTitle(); ?></h3>
									@include('block/' . $event->identifier, ['activity' => $event])
								</div>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
@stop
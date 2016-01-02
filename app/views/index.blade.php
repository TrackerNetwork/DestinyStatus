@extends('layout')
@section('content')
<?php
/**
 * @var \Destiny\Advisors $advisors
 * @var array $news
 * @var array $entry
 */
?>

<?php if(isset($advisors)): ?>
	<?php if($advisors->events->count()): ?>
	<h3>Current events</h3>
	<div class="events row">
		<?php foreach($advisors->events as $event): ?>
			<div class="col-md-4">@include('block/advisor', ['advisor' => $event])</div>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>

	<div class="activities row">
		@if($advisors->daily)
		<div class="col-md-4 daily">
			<h3>Daily Story Mission</h3>
			@include('block/advisor', ['advisor' => $advisors->daily])
		</div>
		@endif

		@if($advisors->heroic)
		<div class="col-md-4 heroic">
			<h3>Weekly Heroic Strike</h3>
			@include('block/advisor', ['advisor' => $advisors->heroic])
		</div>
		@endif

		@if($advisors->nightfall)
		<div class="col-md-4 nightfall">
			<h3>Weekly Nightfall Strike</h3>
			@include('block/advisor', ['advisor' => $advisors->nightfall])
		</div>
		@endif
	</div>

	<h3>Prison of Elders</h3>
	<div class="arenas row">
		@foreach($advisors->arenas as $arena)
		<div class="col-md-4 arena" data-activity-hash="<?= $arena->activityHash ?>">
			@include('block/arena', ['arena' => $arena])
		</div>
		@endforeach
	</div>
<?php endif; ?>

<?php /*
<div class="news">
	<h3>Bungie News</h3>

	@foreach($news as $entry)
	<div class="news-entry">
		<img src="<?= img($entry['author']['profilePicturePath']) ?>">
		<?= e($entry['author']['displayName']) ?><br>
		<?= e($entry['author']['about']) ?>
		<h4>&gt; <?= $entry['properties']['Title'] ?></h4>
		<div><img src="<?= img($entry['properties']['ArticleBanner']) ?>"></div>
		<p><?= $entry['properties']['Summary'] ?></p>
		<p><?= $entry['properties']['Content'] ?></p>
		<?= d($entry) ?>
	</div>
	@endforeach
</div>
*/ ?>

@stop

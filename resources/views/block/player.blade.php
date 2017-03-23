<?php
/**
 * @var \Destiny\Player $player
 * @var string $tab
 */
?>

<div class="player" data-membership-type="<?= $player->membershipType ?>" data-membership-id="<?= $player->membershipId ?>">
	<h1 class="gamertag">
		<?= e($player->displayName) ?>
		<span class="grimoire"><?= $player->account->grimoireScore ?></span>
		@if($player->clanName)<small class="clan"><?= e($player->clanName) ?></small>@endif
	</h1>
</div>

<ul class="nav nav-pills nav-span">
	<li class="<?= $tab == 'account' ? 'active' : '' ?>"><a href="<?= route('account', ['platform' => $player->platform, 'gamertag' => $player->displayName]) ?>">Chars</a></li>
	<li class="<?= $tab == 'grimoire' ? 'active' : '' ?>"><a href="<?= route('grimoire', ['platform' => $player->platform, 'gamertag' => $player->displayName]) ?>">Grimoire</a></li>
	<li class="<?= $tab == 'exotics' ? 'active' : '' ?>"><a href="<?= route('exotics', ['platform' => $player->platform, 'gamertag' => $player->displayName]) ?>">Exotics</a></li>
	<li class="<?= $tab == 'stats' ? 'active' : '' ?>"><a href="<?= route('stats', ['platform' => $player->platform, 'gamertag' => $player->displayName]) ?>">Stats</a></li>
	<li class="<?= $tab == 'books' ? 'active' : '' ?>"><a href="<?= route('books', ['platform' => $player->platform, 'gamertag' => $player->displayName]) ?>">Books</a></li>
</ul>

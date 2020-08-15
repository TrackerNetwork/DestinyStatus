<?php
/** @var Destiny\Player $player */
/** @var string $tab */
?>
<ul class="nav nav-pills nav-span">
    <li class="<?= $tab == 'account' ? 'active' : '' ?>"><a href="<?= route('account', ['platform' => $player->platform, 'name' => url_slug($player->displayName)]) ?>">Chars</a></li>
    <li class="<?= $tab == 'clan' ? 'active' : '' ?>"><a href="<?= route('clan', ['platform' => $player->platform, 'name' => url_slug($player->displayName)]) ?>">Clan</a></li>
</ul>
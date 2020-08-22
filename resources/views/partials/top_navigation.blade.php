<?php
    /** @var Destiny\Player $player */
    /** @var string $tab */
    use App\Helpers\StringHelper;
?>
<ul class="nav nav-pills nav-span">
    <li class="<?= $tab == 'account' ? 'active' : '' ?>">
        <a href="<?= route('account', ['platform' => $player->platform, 'name' => StringHelper::urlSlug($player->displayName)]) ?>">
            Chars
        </a>
    </li>
    <li class="<?= $tab == 'clan' ? 'active' : '' ?>">
        <a href="<?= route('clan', ['platform' => $player->platform, 'name' => StringHelper::urlSlug($player->displayName)]) ?>">
            Clan
        </a>
    </li>
</ul>
<?php

namespace Destiny;

/**
 * @property string $iconPath
 * @property string $membershipType
 * @property string $membershipId
 * @property string $displayName
 * @property string $platform
 * @property string $platformName
 * @property string $platformIcon
 * @property string $clanName
 * @property string $url
 */
class Player extends Model
{
    protected function gPlatform()
    {
        return $this->membershipType == 2 ? 'psn' : 'xbl';
    }

    protected function gPlatformName()
    {
        return $this->membershipType == 2 ? 'PlayStation' : 'Xbox';
    }

    protected function gPlatformIcon()
    {
        return $this->membershipType == 2 ? '/img/psn.png' : '/img/xbl.png';
    }

    protected function gUrl()
    {
        return route('account', ['platform' => $this->platform, 'player' => $this->displayName]);
    }
}
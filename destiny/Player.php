<?php
declare(strict_types=1);

namespace Destiny;

use App\Enums\Console;

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
    protected function gPlatform() : string
    {
        switch ($this->membershipType) {
            case Console::Xbox:
                return 'xbl';
            case Console::Playstation:
                return 'psn';
            case Console::Blizzard:
                return 'pc';
            default:
                return 'Unknown: ' . $this->membershipType;
        }
    }

    protected function gPlatformName() : string
    {
        switch ($this->membershipType) {
            case Console::Xbox:
                return 'Xbox';
            case Console::Playstation:
                return 'PlayStation';
            case Console::Blizzard:
                return 'PC';
            default:
                return 'Unknown: ' . $this->membershipType;
        }
    }

    protected function gPlatformIcon() : string
    {
        return '/img/' . $this->platform . '.png';
    }

    protected function gUrl() : string
    {
        return route('account', ['platform' => $this->platform, 'player' => $this->displayName]);
    }
}

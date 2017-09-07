<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Enums\Console;

class ConsoleHelper
{
    /**
     * @param string $console
     *
     * @throws \Exception
     *
     * @return int
     */
    public static function getIdFromConsoleString(string $console) : int
    {
        switch (strtolower($console)) {
            case 'xbl':
            case 'xbox':
                return Console::Xbox;
            case 'psn':
                return Console::Playstation;
            case 'pc':
                return Console::Blizzard;
            default:
                throw new \Exception('Unknown console: '.$console);
        }
    }

    /**
     * @param int $id
     *
     * @return string
     */
    public static function getConsoleStringFromId(int $id) : string
    {
        switch ($id) {
            case Console::Xbox:
                return 'xbl';
            case Console::Playstation:
                return 'psn';
            case Console::Blizzard:
                return 'pc';
            default:
                return 'Unknown: '.$id;
        }
    }

    /**
     * @param string $console
     *
     * @return string
     */
    public static function getPlatformImage(string $console) : string
    {
        return asset('/img/'.$console.'.png', !\App::isLocal());
    }
}

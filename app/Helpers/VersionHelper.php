<?php
declare(strict_types = 1);

namespace App\Helpers;

class VersionHelper
{
    public static function version($update = false)
    {
        static $version;

        if (!\App::isLocal()) {
            $update = true;
        }

        if ($version && !$update) {
            return trim($version);
        }

        $versionFile = base_path('.version.php');
        if (!is_file($versionFile) || $update) {
            exec('git describe --always', $version);
            $version = array_shift($version) ?: '0-unknown';
            if ($version[0] == 'v') {
                $version = substr($version, 1);
            }
            file_put_contents($versionFile, "<?php return '$version';");
        } else {
            $version = require $versionFile;
        }

        return trim($version);
    }
}
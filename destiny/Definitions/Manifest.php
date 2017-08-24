<?php

namespace Destiny\Definitions;

/**
 * Class Manifest
 * @package Destiny\Definitions
 * @property string $version
 * @property string $mobileAssetContentPath
 * @property array $mobileGearAssetDataBases (GearAsset)
 * @property array $mobileWorldContentPaths
 * @property string $mobileClanBannerDatabasePath
 * @property array $mobileGearCDN
 */
class Manifest extends Definition
{
    protected $appends = [
    ];
}
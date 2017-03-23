<?php

namespace Destiny\Grimoire;

use Destiny\Grimoire;

/**
 * @property string $themeId
 * @property string $themeName
 * @property array $normalResolution
 * @property array $highResolution
 * @property \Destiny\Grimoire\PageCollection $pageCollection
 * @property string $imagePath
 * @property \Destiny\Grimoire\Image $image
 * @property \Destiny\Grimoire\Image $thumbnail
 */
class Theme extends Model
{
    public function __construct(Grimoire $grimoire, array $properties)
    {
        parent::__construct($grimoire, $properties);
        $this->pageCollection = new PageCollection($this, $properties['pageCollection']);
    }

    protected function gImage()
    {
        return new Image($this->normalResolution['image']);
    }

    protected function gThumbnail()
    {
        return new Image($this->highResolution['smallImage']);
    }
}

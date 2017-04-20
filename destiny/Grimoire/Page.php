<?php

namespace Destiny\Grimoire;

/**
 * @property string $pageId
 * @property string $pageName
 * @property array $normalResolution
 * @property array $highResolution
 * @property \Destiny\Grimoire\CardCollection $cardBriefs
 * @property string $imagePath
 * @property \Destiny\Grimoire\Image $image
 * @property \Destiny\Grimoire\Image $thumbnail
 * @property \Destiny\Grimoire\Theme $theme
 * @property \Destiny\Grimoire\Card[] $cards
 */
class Page extends Model
{
    protected $theme;

    public function __construct(Theme $theme, array $properties)
    {
        parent::__construct($theme->grimoire, $properties);
        $this->theme = $theme;
        $this->cardBriefs = new CardCollection($this, $properties['cardBriefs']);
    }

    protected function gImage()
    {
        return new Image($this->normalResolution['image']);
    }

    protected function gThumbnail()
    {
        return new Image($this->highResolution['smallImage']);
    }

    protected function gTheme()
    {
        return $this->theme;
    }
}

<?php namespace Destiny\Grimoire;

class Image
{
	public $rectX;
	public $rectY;
	public $rectWidth;
	public $rectHeight;
	public $sheetPath;
	public $sheetX;
	public $sheetY;
	public $sheetWidth;
	public $sheetHeight;

	public function __construct(array $properties)
	{
		$this->rectX = array_get($properties, 'rect.x');
		$this->rectY = array_get($properties, 'rect.y');
		$this->rectWidth = array_get($properties, 'rect.width');
		$this->rectHeight = array_get($properties, 'rect.height');
		$this->sheetPath = array_get($properties, 'sheetPath');
		$this->sheetX = array_get($properties, 'sheetSize.x');
		$this->sheetY = array_get($properties, 'sheetSize.y');
		$this->sheetWidth = array_get($properties, 'sheetSize.width');
		$this->sheetHeight = array_get($properties, 'sheetSize.height');
	}

	function __toString()
	{
		$canvas = '<canvas class="sprite"
			width="'.$this->rectWidth.'"
			height="'.$this->rectHeight.'"
			data-x="'.$this->rectX.'"
			data-y="'.$this->rectY.'"
			data-src="'.bungie($this->sheetPath).'"
			></canvas>';

		return $canvas;
	}
}

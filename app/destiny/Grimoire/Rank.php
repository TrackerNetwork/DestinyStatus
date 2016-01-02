<?php namespace Destiny\Grimoire;

use Destiny\Grimoire;

/**
 * @property int $rank
 * @property string $rankName
 * @property int $offset
 * @property int $threshold
 * @property int $points
 * @property float $percent
 * @property float $percentDisplay
 * @property string $percentLabel
 * @property string $displayValue
 * @property bool $completed
 * @property bool $inProgress
 *
 * @property \Destiny\Grimoire\Card $card
 */
class Rank extends Model
{
	protected $statistic;

	public function __construct(Statistic $statistic, array $properties)
	{
		parent::__construct($statistic->grimoire, $properties);
		$this->statistic  = $statistic;
		$this->inProgress = ($statistic->value >= $this->offset && $statistic->value < $this->threshold);
		$this->completed  = ($statistic->value >= $this->threshold);
	}

	protected function gCard()
	{
		return $this->statistic->card;
	}

	protected function gRankName()
	{
		return 'Rank '.$this->rank;
	}

	protected function gPercent()
	{
		if ( ! $this->completed && ! $this->inProgress) return 0;

		$percent = $this->statistic->value / $this->threshold * 100;

		if ($percent > 100) $percent = 100;

		return $percent;
	}

	protected function gPercentDisplay()
	{
		$value = $this->statistic->value;

		if ( ! $this->completed && ! $this->inProgress) return 0;

		if ($value > $this->threshold) return 100;

		$value = $this->statistic->value - $this->offset;
		$max   = $this->threshold - $this->offset;
		$percent = $value / $max * 100;

		if ($percent > 100) $percent = 100;

		return $percent;
	}

	protected function gPercentLabel()
	{
		if ($this->completed)
		{
			return '<span class="grimoire">'.$this->points.'</span>';
		}

		return $this->displayValue;
	}

	protected function gDisplayValue()
	{
		if ($this->completed) return 'Complete';
		if ($this->inProgress) return $this->statistic->displayValue.' / '.$this->threshold;
		return $this->threshold;
	}
}

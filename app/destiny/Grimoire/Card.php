<?php namespace Destiny\Grimoire;

use Destiny\Grimoire;

/**
 * @property int $cardId
 * @property string $cardName
 * @property int $points
 * @property int $totalPoints
 * @property int $score
 * @property \Destiny\Grimoire\StatisticCollection $statisticCollection
 *
 * @property \Destiny\Definitions\GrimoireCard $definition
 * @property string $imagePath
 * @property \Destiny\Grimoire\Image $image
 * @property \Destiny\Grimoire\Image $thumbnail
 * @property \Destiny\Grimoire\Theme $theme
 * @property \Destiny\Grimoire\Page $page
 * @property \Destiny\Grimoire\CardStatus $status
 * @property bool $active
 * @property float $percent
 * @property \Destiny\Grimoire\Statistic[] $statistics
 */
class Card extends Model
{
	/**
	 * @var \Destiny\Grimoire\Page
	 */
	protected $page;

	/**
	 * @var array
	 */
	protected $unobtainable = [
		'302030', // Fate of All Fools
	];

	/**
	 * @var array
	 */
	protected $nostats = [
		#'609012' // Doubles
		#'103094', // Dead Ghosts
	];

	/**
	 * @var array
	 */
	protected $patchTotalPoints = [
		/*
		'107020' => 15, // Ghost Fragment: Rasputin 3
		'107030' => 10, // Ghost Fragment: Rasputin 2
		'201158' => 10, // Ghost Fragment: Hive 4
		'502130' => 5, // The Wakening
		'601071' => 15, // Omnigul, Will of Crota
		'601074' => 15, // Ir Yût, the Deathsinger
		'601145' => 5, // Will of Crota
		'603035' => 5, // Crota's End
		'603040' => 5, // Ascendant Sword
		'609130' => 5, // The Cauldron
		'609170' => 5, // Pantheon
		'609180' => 5, // Skyshock
		'692030' => 15, // Might of Crota
		*/
	];

	/**
	 * @var array
	 */
	protected $psnExclusive = [
		'701650' => 'Echo Chamber',
		'701700' => 'Sector 618',
		'700150' => 'The Jade Rabit',
		'700590' => 'Theosyion, the Restorative Mind',
		'701370' => 'Ghost Fragment: Vex 5',
		'790010' => 'Zen Meteor'
	];

	public function __construct(Page $page, array $properties)
	{
		parent::__construct($page->grimoire, $properties);
		$this->active = false;
		$this->score = 0;
		$this->page = $page;
		$this->statisticCollection = new StatisticCollection($this, $this->definition->statisticCollection);

		if ($this->status)
		{
			$this->active = true;
			$this->score = $this->status->score;
		}
	}

	protected function gDefinition()
	{
		return manifest()->grimoireCard($this->cardId);
	}

	protected function gTheme()
	{
		return $this->page->theme;
	}

	protected function gPage()
	{
		return $this->page;
	}

	protected function gStatus()
	{
		return $this->grimoire->cardCollection->get($this->cardId);
	}

	public function hasStats()
	{
		return ! $this->statisticCollection->isEmpty();
	}

	public function hasRanks()
	{
		if ( ! $this->hasStats()) return false;

		foreach ($this->statistics as $stat)
		{
			if ($stat->hasRanks())
			{
				return true;
			}
		}

		return false;
	}

	public function isObtainable()
	{
		return ! in_array($this->cardId, $this->unobtainable);
	}

	public function isIncomplete()
	{
		if ( ! $this->active)
		{
			return true;
		}

		return $this->score < $this->totalPoints;
	}

	public function isPlaystationExclusive()
	{
		return array_key_exists($this->cardId, $this->psnExclusive);
	}

	protected function gCardName()
	{
		return $this->definition->cardName;
	}

	protected function gImage()
	{
		return new Image($this->definition->normalResolution['image']);
	}

	protected function gThumbnail()
	{
		return new Image($this->definition->highResolution['smallImage']);
	}

	protected function gStatistics()
	{
		return $this->statisticCollection;
	}

	protected function gActive()
	{
		return $this->grimoire->cardCollection->has($this->cardId);
	}

	protected function gTotalPoints()
	{
		$points = $this->points;

		foreach ($this->statisticCollection as $stat)
		{
			$points += $stat->points;
		}

		return array_get($this->patchTotalPoints, $this->cardId, $points);
	}

	protected function gPercent()
	{
		if ($this->hasRanks())
		{
			$values = [];
			foreach ($this->statistics as $stat)
			{
				if ($stat->hasRanks())
				{
					$values[] = $stat->percent;
				}
			}

			return array_sum($values) / count($values);
		}

		if ( ! $this->totalPoints)
		{
			return $this->active ? 100 : 0;
		}

		return ($this->score / $this->totalPoints * 100);
	}
}

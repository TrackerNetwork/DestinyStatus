<?php namespace Destiny;
use Destiny\Character\Statistics;

/**
 * @property array $mergedAllCharacters
 * @property \Destiny\Collection $characters
 */
class AccountStatistics extends Model
{
	/**
	 * @var \Destiny\Account
	 */
	protected $account;

	/**
	 * @var \Destiny\StatisticsCollection
	 */
	public $pve;

	/**
	 * @var \Destiny\StatisticsCollection
	 */
	public $pvp;

	public function __construct(Account $account, array $properties = null)
	{
		parent::__construct($properties ?: []);
		$this->account = $account;
	}

	protected function gMergedAllCharacters()
	{
		return $this->newCollection($this->properties['mergedAllCharacters']);
	}

	protected function gCharacters()
	{
		$characters = $this->newCollection();
		foreach (array_get($this->properties, 'characters', []) as $character)
		{
			$key = (string) $character['characterId'];
			$characters->put($key, $character);
		}

		return $characters;
	}

	public function character($id)
	{
		$character = $this->account->characters->get($id);
		$stats     = $this->characters->get($id, []);

		return new Statistics($character, $stats);
	}
}

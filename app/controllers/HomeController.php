<?php

class HomeController extends BaseController
{
	public function index()
	{
		$gamertag = Input::get('gamertag');

		if ($gamertag)
		{
			$result = destiny()->player($gamertag, false);

			if ($result->count() == 1)
			{
				return Redirect::to($result->first()->url);
			}
			elseif ($result->count() > 1)
			{
				return Redirect::route('select', ['gamertag' => $gamertag]);
			}

			return View::make('search', ['gamertag' => $gamertag, 'result' => $result]);
		}

		$advisors = destiny()->advisors();

		return View::make('index', [
			'advisors' => $advisors,
		]);
	}

	public function select($gamertag)
	{
		$players = destiny()->player($gamertag);

		if ($players->count() == 1)
		{
			return Redirect::to($players->first()->url);
		}

		return View::make('select', ['gamertag' => $gamertag, 'players' => $players]);
	}
}

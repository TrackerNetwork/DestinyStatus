<?php

namespace App\Http\Controllers;

use App\Account;

/**
 * Class UtilController
 * @package App\Http\Controllers
 */
class UtilController extends Controller
{
    /**
     * @return string
     */
    public function searchAutocomplete()
    {
        $query = \Request::get('query');

        return Account::where('slug', 'LIKE', '%'.$query.'%')
            ->limit(15)
            ->distinct()
            ->orderBy('name')
            ->pluck('name')
            ->toJson();
    }
}

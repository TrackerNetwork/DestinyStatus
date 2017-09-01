<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector as Redirect;
use Illuminate\View\Factory as View;

class HomeController extends Controller
{
    /**
     * @var Request
     */
    public $request;

    /**
     * @var Redirect
     */
    public $redirect;

    /**
     * @var View
     */
    public $view;

    /**
     * HomeController constructor.
     *
     * @param Request  $request
     * @param Redirect $redirect
     * @param View     $view
     */
    public function __construct(Request $request, Redirect $redirect, View $view)
    {
        $this->request = $request;
        $this->redirect = $redirect;
        $this->view = $view;
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $gamertag = $this->request->get('gamertag');

        if ($gamertag) {
            $result = destiny()->player($gamertag);

            if ($result->count() == 1) {
                return $this->redirect->to($result->first()->url);
            } elseif ($result->count() > 1) {
                return $this->redirect->route('select', ['gamertag' => $gamertag]);
            }

            return $this->view->make('search', ['gamertag' => $gamertag, 'result' => $result]);
        }

        return $this->view->make('index', [
            //'advisors' => destiny()->advisors(),
        ]);
    }

    /**
     * @param $gamertag
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function select($gamertag)
    {
        $players = destiny()->player($gamertag);

        if ($players->count() == 1) {
            return $this->redirect->to($players->first()->url);
        }

        return $this->view->make('select', ['gamertag' => $gamertag, 'players' => $players]);
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function privacy()
    {
        return $this->view->make('privacy');
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function faq()
    {
        return $this->view->make('faq', [
            'badges' => Badge::all()->mapWithKeys(function (Badge $badge) {
                return [$badge->slug => $badge->ui()];
            }),
        ]);
    }
}

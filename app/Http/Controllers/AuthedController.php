<?php

namespace App\Http\Controllers;

use App\Models\Bungie;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector as Redirect;
use Illuminate\View\Factory as View;

/**
 * Class AuthedController
 * @package App\Http\Controllers
 */
class AuthedController extends Controller
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

    public function preferredSwitch($id = null)
    {
        if (! empty($id)) {
            /** @var Bungie $bungie */
            $bungie = \Auth::user();
            $bungie->preferred_account_id = $id;
            $bungie->saveOrFail();

            \Session::flash('success', 'Active account has been set as - <strong>'.$bungie->account->name.'</strong>');
            return $this->redirect->to('/');
        }

        return $this->view->make('preferred-account', [
            'bungie' => \Auth::user()
        ]);
    }

    public function logout()
    {
        \Auth::logout();

        \Session::flash('success', 'You have logged out.');

        return redirect('/');
    }
}

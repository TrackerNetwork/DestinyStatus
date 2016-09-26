<?php

namespace App\Exceptions;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
        ModelNotFoundException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
    	if ($e instanceof \UnknownPlayerException) {
    		Bugsnag::notifyException($e);
			return response()->view('error', ['error' => $e->getMessage()]);
		}

		if ($e instanceof \DestinyException) {
			Bugsnag::notifyException($e);
			return response()->view('error', ['error' => $e->getMessage(), 'bungie' => true]);
		}

		if ($e instanceof \DestinyLegacyPlatformException) {
			return response()->view('error', ['error' => $e->getMessage(), 'bungie' => true]);
		}

		if (\Config::get('app.debug'))
		{
			\Session::flash('alert', sprintf("%s (Line %d): %s", $e->getFile(), $e->getLine(), $e->getMessage()));
		}
		else
		{
			if (strlen($e->getMessage()) > 1)
			{
				\Session::flash('alert', $e->getMessage());
			}
		}

		if ($e instanceof ModelNotFoundException) {
            $e = new NotFoundHttpException($e->getMessage(), $e);
        }

		if (config('app.debug') && app()->environment() != 'testing') {
			return $this->renderExceptionWithWhoops($request, $e);
		}

        return parent::render($request, $e);
    }

	/**
	 * Render an exception using Whoops.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Exception $e
	 * @return \Illuminate\Http\Response
	 */
	protected function renderExceptionWithWhoops($request, Exception $e)
	{
		$whoops = new \Whoops\Run;

		if ($request->ajax()) {
			$whoops->pushHandler(new \Whoops\Handler\JsonResponseHandler());
		} else {
			$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());
		}

		return new \Illuminate\Http\Response(
			$whoops->handleException($e),
			$e->getStatusCode(),
			$e->getHeaders()
		);
	}
}

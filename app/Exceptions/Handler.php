<?php

namespace App\Exceptions;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param \Exception $exception
     *
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param Exception                $exception
     *
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof \UnknownPlayerException) {
            return response()->view('error', ['error' => $exception->getMessage()]);
        }
        if ($exception instanceof \DestinyException) {
            Bugsnag::notifyException($exception);

            return response()->view('error', ['error' => $exception->getMessage(), 'bungie' => true]);
        }

        if (\App::isLocal()) {
            \Session::flash('alert', sprintf('%s (Line %d): %s', $exception->getFile(), $exception->getLine(), $exception->getMessage()));
        } else {
            if (strlen($exception->getMessage()) > 1) {
                \Session::flash('alert', $exception->getMessage());
            }
        }
        if ($exception instanceof ModelNotFoundException) {
            $exception = new NotFoundHttpException($exception->getMessage(), $exception);
        }

        return parent::render($request, $exception);
    }
}

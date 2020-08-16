<?php

namespace App\Exceptions;

use App\Exceptions\Destiny\GenericDestinyException;
use App\Exceptions\Destiny\NoClanException;
use App\Exceptions\Destiny\UnknownPlayerException;
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

    public function report(\Throwable $exception)
    {
        parent::report($exception);
    }

    public function render($request, \Throwable $exception)
    {
        if ($exception instanceof UnknownPlayerException) {
            return response()->view('error', ['error' => $exception->getMessage()]);
        }
        if ($exception instanceof NoClanException) {
            return response()->view('error', ['error' => $exception->getMessage()]);
        }
        if ($exception instanceof GenericDestinyException) {
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

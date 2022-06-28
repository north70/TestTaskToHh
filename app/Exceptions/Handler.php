<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Tymon\JWTAuth\Exceptions\JWTException;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, $e)
    {
        if ($e instanceof NotFoundHttpException) {
            return $this->formatException($e, (int)$e->getStatusCode(), 'Not found');
        } elseif ($e instanceof ModelNotFoundException) {
            return $this->formatException($e,Response::HTTP_BAD_REQUEST);
        } elseif ($e instanceof MethodNotAllowedHttpException) {
            return $this->formatException($e,(int)$e->getStatusCode());
        } else if ($e instanceof QueryException) {
            return $this->formatException($e,Response::HTTP_BAD_REQUEST);
        }

        return parent::render($request, $e);
    }

    public function formatException($e,$code, $message = '')
    {
        $message = $message ?: (string)$e->getMessage();
        return response()->json([
            'error' => last(explode('\\',get_class($e))),
            'message' => $message
        ], $code);
    }
}

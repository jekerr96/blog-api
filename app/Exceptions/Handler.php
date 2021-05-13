<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

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

    public function render($request, Throwable $e) {
        if ($e instanceof HttpException) {
            if ($e->getStatusCode() == Response::HTTP_NOT_FOUND) {
                return response()->json(["error" => "Resource not found"], Response::HTTP_NOT_FOUND);
            } elseif ($e->getStatusCode() == Response::HTTP_FORBIDDEN) {
                return response()->json(["error" => $e->getMessage()], $e->getStatusCode());
            }
        }

        return parent::render($request, $e);
    }
}

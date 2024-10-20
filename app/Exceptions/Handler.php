<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

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

    public function render($request, Throwable $exception)
    {
        // Tangani khusus untuk QueryException
        if ($exception instanceof QueryException) {
            return response()->view('errors.query', [
                'errorMessage' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine()
            ], 500);
        }

        // Tangani khusus untuk HttpException (404, 403, dll.)
        if ($exception instanceof HttpExceptionInterface) {
            $statusCode = $exception->getStatusCode();
            return response()->view("errors.{$statusCode}", [], $statusCode);
        }

        // Jika dalam mode debug, tampilkan pesan error lengkap
        if (config('app.debug')) {
            return response()->view('errors.debug', [
                'exception' => $exception
            ], 500);
        }

        // Default error handling
        return response()->view('errors.default', [], 500);
    }
}

<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($request->expectsJson() || $request->is('api/*')) {
            return $this->handleJsonResponse($exception);
        }

        return parent::render($request, $exception);
    }

    protected function handleJsonResponse(Throwable $exception)
    {
        $message = $exception->getMessage();
        $statusCode = $this->getStatusCode($exception);

        $errors = [];

        if ($exception instanceof ValidationException) {
            $errors = $exception->errors();
        }

        return new JsonResponse([
            'message' => $message,
            'errors' => $errors
        ], $statusCode);
    }

    protected function getStatusCode(Throwable $exception)
    {
        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\HttpException) {
            return $exception->getStatusCode();
        }

        return 500;
    }

}

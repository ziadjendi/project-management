<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
    //
    })
    ->withExceptions(function (Exceptions $exceptions) {

        $exceptions->render(function (Throwable $exception) {
                    // dd($exception);
            if ($exception instanceof MethodNotAllowedHttpException) {
                $allowedMethods = $exception->getHeaders()['Allow'];
                if (is_string($allowedMethods)) {
                    $allowedMethods = explode(', ', $allowedMethods);
                }

                return response()->json([
                    'message' => 'Method Not Allowed. Supported methods: ' . implode(', ', $allowedMethods),
                    'code' => 405,
                ], 405);
            }

            if ($exception instanceof NotFoundHttpException || $exception instanceof ModelNotFoundException) {
                return response()->json([
                    'message' => 'Resource not found',
                    'code' => 404,
                ], 404);

            }

            if ($exception instanceof ValidationException) {
                return response()->json([
                    'message' => 'Validation Error',
                    'errors' => $e->errors(),
                ], 400);
            }



        });
    })->create();

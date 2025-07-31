<?php

use Carbon\Exceptions\UnreachableException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Traits\V1\ApiResponse;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
    $exceptions->render(
        function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return ApiResponse::fail('Resource Not Found', 404);
            }
        }
    );

    $exceptions->render(function (ValidationException $e, Request $request) {
        if ($request->is('api/*')) {
            return ApiResponse::fail('The data did not pass the validation.', $e->errors(), 301);
        }
    });

    $exceptions->render(function (AuthenticationException $e, Request $request) {
        if ($request->is('api/*')) {
            return ApiResponse::fail($e->getMessage(), [], 401);
        }
    });

    $exceptions->render(function (AuthorizationException $e, Request $request) {
        if ($request->is('api/*')) {
            return ApiResponse::fail('You are not authorized to do that.', [], 403);
        }
    });

    $exceptions->render(function (AccessDeniedHttpException $e, Request $request) {
        if ($request->is('api/*')) {
            return ApiResponse::fail('You do not have permission to do that.', [], 403);
        }
    });

    $exceptions->render(function (UnreachableException $e, Request $request) {
        if ($request->is('api/*')) {
            return ApiResponse::fail($e->getMessage(), [], 401);
        }
    });

    $exceptions->render(function (ThrottleRequestsException $e, Request $request) {
        return response()->json([
            'message' => 'Too many requests. Please slow down.',
        ], 429);
    });

    $exceptions->render(function (Exception $e, Request $request) {
        if ($request->is('api/*')) {
            return ApiResponse::fail('Internal Server Error', $e->getMessage(), 500);
        }
    });
    })->create();

<?php

declare(strict_types=1);

use App\Helpers\RoutesHelper;
use App\Http\Middleware\JWTAuthMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: RoutesHelper::buildRoutingFilesArray(),
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'auth.jwt' => JWTAuthMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (Throwable $e, $request) {
            if (str_starts_with((string) $request->path(), 'api/')) {
                return response()->json([
                    'error' => $e->getMessage(),
                ], method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500);
            }

            return null;
        });
    })->create();

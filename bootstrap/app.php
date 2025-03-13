<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',        // ✅ Calls all your web routes, including admin panel
        commands: __DIR__.'/../routes/console.php',
        health: '/up',                           // Optional: Health check route
    )
    ->withMiddleware(function (Middleware $middleware) {
        // ✅ Route middleware alias for 'admin' (you can now use 'admin' in routes)
        $middleware->alias([
            'admin' => \App\Http\Middleware\IsAdmin::class,
        ]);

        // Optional: Global middleware can also be appended if needed:
        // $middleware->append([
        //     \App\Http\Middleware\ExampleGlobalMiddleware::class,
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Optional: Customize exception reporting or handling
        // $exceptions->report(function (Throwable $e) {
        //     // Custom logic
        // });
    })
    ->create();

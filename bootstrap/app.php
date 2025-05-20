<?php

use App\Console\Commands\UpdateMadingStatus;
use App\Http\Middleware\AccessKey;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->api(prepend: [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        ]);

        $middleware->alias([
            'verified' => \App\Http\Middleware\EnsureEmailIsVerified::class,
            'role' => \App\Http\Middleware\EnsureRole::class,
            'access-key' => AccessKey::class,
        ]);

        //
    })
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command('update:mading-status')->daily();
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

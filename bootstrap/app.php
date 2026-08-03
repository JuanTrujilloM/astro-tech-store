<?php

use App\Http\Middleware\AdminAuthMiddleware;
use App\Http\Middleware\SetCurrency;
use App\Http\Middleware\SetLocale;
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
    ->withMiddleware(function (Middleware $middleware): void {
        // Hosts that terminate TLS on a reverse proxy (Render) must set
        // TRUSTED_PROXIES=* so Laravel builds https:// URLs. Left unset, no
        // proxy is trusted, which is the correct behaviour when Apache is
        // exposed directly, as it is on the GCP VM.
        if ($proxies = env('TRUSTED_PROXIES')) {
            $middleware->trustProxies(at: $proxies);
        }

        $middleware->web(append: [
            SetLocale::class,
            SetCurrency::class,
        ]);

        $middleware->alias([
            'admin' => AdminAuthMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

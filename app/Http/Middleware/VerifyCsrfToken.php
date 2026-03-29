<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',   // Asegúrate que esta línea esté
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        // ←←← AGREGAMOS ESTO ←←←
        $middleware->validateCsrfTokens(except: [
            'api/*',           // Excluye todas las rutas que empiecen con /api
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
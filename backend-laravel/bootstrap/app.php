<?php

use Illuminate\Foundation\Application;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->prepend(\Illuminate\Http\Middleware\HandleCors::class);


       // Register route middleware aliases
        $middleware->alias([
            'auth' => Authenticate::class,
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
        ]);
       
    })
    

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\ClienteMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectGuestsTo(function ($request){
            if($request->is('admin') || $request->is('admin/*'))
            {
                return route('admin.login');
            }
            return route('login');
        });
        $middleware->alias([
            'cliente' => ClienteMiddleware::class,
            'admin' => AdminMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

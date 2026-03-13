<?php

use Illuminate\Http\Request;
use App\Http\Middleware\Google2FA;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        $middleware->web(append: [
            \App\Http\Middleware\GlobalSettingsMiddleware::class,
        ]);

        $middleware->redirectGuestsTo(function (Request $request) {
            if ($request->is('admin-lt*')) {
                return route('admin.login');
            }
            return route('home'); 
        });

        $middleware->alias([
            '2fa' => \App\Http\Middleware\Google2FA::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
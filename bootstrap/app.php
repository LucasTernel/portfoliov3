<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

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
        
        // Si l'URL commence par "admin-lt", on redirige vers le login admin
        if ($request->is('admin-lt*')) {
            return route('admin.login');
        }
        
        // Sinon, comportement par défaut (ou vers l'accueil si tu n'as pas d'espace membre)
        return route('home'); 
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FALaravel\Support\Authenticator;

class Google2FA
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user && is_null($user->google2fa_secret)) {
            if ($request->routeIs('2fa.enable') || $request->routeIs('2fa.enable.post')) {
                return $next($request);
            }
            
            return redirect()->route('2fa.enable');
        }

        $authenticator = app(Authenticator::class)->boot($request);

        if ($authenticator->isAuthenticated()) {
            return $next($request);
        }

        return response()->view('admin.2fa.index');
    }
}
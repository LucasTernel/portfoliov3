<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth; // Indispensable pour vérifier l'admin

class GlobalSettingsMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $settings = Setting::first();

        if (!$settings) {
            return $next($request);
        }

        View::share('globalSettings', $settings);


        if ($settings->maintenance_scheduled_at && now()->greaterThanOrEqualTo($settings->maintenance_scheduled_at)) {
            $settings->update([
                'maintenance_mode' => true,
                'maintenance_scheduled_at' => null
            ]);
            ActivityLog::record('Mode Maintenance Activé', 'Le mode maintenance a été activé automatiquement selon le planning à l\'heure suivante : ' . $settings->maintenance_scheduled_at);
            $settings->refresh();
        }

        if ($settings->maintenance_mode && $settings->maintenance_ends_at && now()->greaterThanOrEqualTo($settings->maintenance_ends_at)) {
            $settings->update([
                'maintenance_mode' => false,
                'maintenance_ends_at' => null
            ]);
            ActivityLog::record('Mode Maintenance Désactivé', 'Le mode maintenance a été désactivé automatiquement à l\'heure suivante : ' . $settings->maintenance_ends_at);
            $settings->refresh();
        }


        if ($settings->maintenance_mode) {

            if ($request->is('admin-lt/login')) {
                return $next($request);
            }

            if (Auth::check() && Auth::user()->role === 'admin') {
                session()->now('maintenance_warning', 'Mode Maintenance actif (visible seulement par vous)');
                return $next($request);
            }

            abort(503);
        }

        return $next($request);
    }
}
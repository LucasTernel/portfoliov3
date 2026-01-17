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

        // Si pas de settings, on laisse passer (sécurité)
        if (!$settings) {
            return $next($request);
        }

        // Partage global pour les vues (footer, etc.)
        View::share('globalSettings', $settings);

        // ---------------------------------------------------------
        // LOGIQUE DE MAINTENANCE
        // ---------------------------------------------------------

        // ...
        // 1. DÉBUT AUTOMATIQUE (Si programmé)
        if ($settings->maintenance_scheduled_at && now()->greaterThanOrEqualTo($settings->maintenance_scheduled_at)) {
            $settings->update([
                'maintenance_mode' => true,
                'maintenance_scheduled_at' => null
            ]);
            $settings->refresh();
        }

        // 2. FIN AUTOMATIQUE (Si programmée) <-- NOUVEAU
        if ($settings->maintenance_mode && $settings->maintenance_ends_at && now()->greaterThanOrEqualTo($settings->maintenance_ends_at)) {
            $settings->update([
                'maintenance_mode' => false,
                'maintenance_ends_at' => null
            ]);
            $settings->refresh();
        }
        // ...

        // 2. Si le mode Maintenance est ACTIVÉ
        if ($settings->maintenance_mode) {

            // EXCEPTION A : On laisse TOUJOURS accès à la page de Login
            // (Sinon, personne ne peut se connecter pour devenir Admin)
            if ($request->is('admin-lt/login')) {
                return $next($request);
            }

            // EXCEPTION B : Si l'utilisateur est connecté ET qu'il est ADMIN
            // Alors il a le droit de TOUT voir (Site public + Admin panel)
            if (Auth::check() && Auth::user()->role === 'admin') {
                
                // Optionnel : On peut envoyer un petit message flash pour te rappeler que le site est fermé aux autres
                // session()->now('maintenance_warning', 'Mode Maintenance actif (visible seulement par vous)');
                
                return $next($request);
            }

            // POUR TOUS LES AUTRES (Visiteurs, Robots, Non-Admins)
            // On affiche la page de maintenance (Erreur 503)
            abort(503);
        }

        return $next($request);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        // On récupère le premier (et unique) enregistrement
        $settings = Setting::first();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = Setting::first();

        // Validation (On autorise le null)
        $request->validate([
            'ga_tracking_id' => 'nullable|string', 
            'ga_property_id' => 'nullable|string', // <--- Ajout de la validation pour ga_property_id
        ]);

        $data = [
            'maintenance_mode' => $request->has('maintenance_mode'),
            'is_available' => $request->has('is_available'),
            // Vérifie que cette ligne est exacte 👇
            'ga_tracking_id' => $request->input('ga_tracking_id'), 
            'ga_property_id' => $request->input('ga_property_id'), // <--- Ajout de ga_property_id
        ];

        $settings->update($data);

        ActivityLog::record('Mise à jour Paramètres', 'Modification maintenance / disponibilité'); 

        return back()->with('success', 'Paramètres mis à jour.');
    }
}
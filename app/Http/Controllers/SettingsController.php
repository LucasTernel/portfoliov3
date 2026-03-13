<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = Setting::first();
        $request->validate([
            'ga_tracking_id' => 'nullable|string', 
            'ga_property_id' => 'nullable|string', 
        ]);

        $data = [
            'maintenance_mode' => $request->has('maintenance_mode'),
            'is_available' => $request->has('is_available'),
            'ga_tracking_id' => $request->input('ga_tracking_id'), 
            'ga_property_id' => $request->input('ga_property_id'), 
        ];

        $settings->update($data);

        ActivityLog::record('Mise à jour Paramètres', 'Modification maintenance / disponibilité'); 

        return back()->with('success', 'Paramètres mis à jour.');
    }
}
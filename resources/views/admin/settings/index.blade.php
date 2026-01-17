@extends('layouts.app')

@section('content')
<div class="admin-content-wrapper center-content">
    
    <div class="admin-form-card">
        <h1 class="admin-form-title">Paramètres Généraux</h1>

        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            
            <div class="settings-section">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
                    <h3 class="settings-title">Statut Freelance</h3>
                    <div class="{{ $settings->is_available ? 'status-badge-mini green' : 'status-badge-mini red' }}">
                        {{ $settings->is_available ? 'DISPONIBLE' : 'INDISPONIBLE' }}
                    </div>
                </div>

                <div class="toggle-row">
                    <label class="switch">
                        <input type="checkbox" name="is_available" {{ $settings->is_available ? 'checked' : '' }}>
                        <span class="slider round"></span>
                    </label>
                    <span class="toggle-label">Afficher le badge "Disponible" sur le site</span>
                </div>
            </div>

            <hr class="separator">

            <div class="settings-section">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
                    <h3 class="settings-title" style="color: #ff4d4d;">Mode Maintenance</h3>
                    @if($settings->maintenance_mode)
                        <span class="status-badge-mini red">SITE FERMÉ</span>
                    @else
                        <span class="status-badge-mini green">SITE OUVERT</span>
                    @endif
                </div>
                
                <div class="toggle-row">
                    <label class="switch">
                        <input type="checkbox" name="maintenance_mode" {{ $settings->maintenance_mode ? 'checked' : '' }}>
                        <span class="slider round red"></span>
                    </label>
                    <span class="toggle-label">Activer la maintenance (Accès Admin uniquement)</span>
                </div>

                <div class="form-group" style="flex:1; background: #111; padding: 15px; border-radius: 8px; margin-top:15px;">
                    <label style="font-size: 0.9rem; color: #888;">⏰ Programmer le DÉBUT (Optionnel)</label>
                    <input type="datetime-local" name="maintenance_scheduled_at" 
                        class="admin-input" 
                        style="margin-top:5px;"
                        value="{{ $settings->maintenance_scheduled_at ? $settings->maintenance_scheduled_at->format('Y-m-d\TH:i') : '' }}">
                </div>

                <div class="form-group" style="flex:1; background: #111; padding: 15px; border-radius: 8px;">
                    <label style="font-size: 0.9rem; color: #888;">🏁 Programmer la FIN (Optionnel)</label>
                    <input type="datetime-local" name="maintenance_ends_at" 
                        class="admin-input" 
                        style="margin-top:5px;"
                        value="{{ $settings->maintenance_ends_at ? $settings->maintenance_ends_at->format('Y-m-d\TH:i') : '' }}">
                    <small style="color:#666; display:block; margin-top:5px;">Le site se rouvrira tout seul à cette heure.</small>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-neon-pill">Enregistrer les paramètres</button>
            </div>
        </form>
    </div>

</div>
@endsection
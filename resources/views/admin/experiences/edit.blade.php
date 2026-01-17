@extends('layouts.app')

@section('content')
<div class="admin-content-wrapper">
    
    <div class="admin-header-actions">
        <h1 class="admin-page-title">Modifier l'expérience : {{ $experience->title }}</h1>
        <a href="{{ route('admin.experiences.index') }}" class="btn-neon-pill">← Retour</a>
    </div>

    <div class="admin-form-container" style="background: rgba(255,255,255,0.05); padding: 30px; border-radius: 15px; border: 1px solid rgba(255,255,255,0.1); max-width: 900px; margin: 0 auto;">
        
        <form action="{{ route('admin.experiences.update', $experience->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="admin-form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px;">
                <div class="form-group">
                    <label style="display: block; color: #D6F32F; margin-bottom: 8px; font-weight: bold;">Titre</label>
                    <input type="text" name="title" value="{{ old('title', $experience->title) }}" 
                           style="width: 100%; background: #1a1a1a; border: 1px solid #444; color: white; padding: 12px; border-radius: 8px;" required>
                </div>

                <div class="form-group">
                    <label style="display: block; color: #D6F32F; margin-bottom: 8px; font-weight: bold;">Rôle</label>
                    <input type="text" name="role" value="{{ old('role', $experience->role) }}" 
                           style="width: 100%; background: #1a1a1a; border: 1px solid #444; color: white; padding: 12px; border-radius: 8px;" required>
                </div>
            </div>

            <div class="admin-form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px;">
                <div class="form-group">
                    <label style="display: block; color: #D6F32F; margin-bottom: 8px; font-weight: bold;">Période</label>
                    <input type="text" name="date_range" value="{{ old('date_range', $experience->date_range) }}" 
                           style="width: 100%; background: #1a1a1a; border: 1px solid #444; color: white; padding: 12px; border-radius: 8px;" required>
                </div>

                <div class="form-group">
                    <label style="display: block; color: #D6F32F; margin-bottom: 8px; font-weight: bold;">Dossier</label>
                    <input type="text" name="folder_name" value="{{ old('folder_name', $experience->folder_name) }}" 
                           style="width: 100%; background: #1a1a1a; border: 1px solid #444; color: white; padding: 12px; border-radius: 8px;" required>
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 25px;">
                <label style="display: block; color: #D6F32F; margin-bottom: 8px; font-weight: bold;">Description</label>
                <textarea name="description" rows="4" style="width: 100%; background: #1a1a1a; border: 1px solid #444; color: white; padding: 12px; border-radius: 8px; resize: vertical;" required>{{ old('description', $experience->description) }}</textarea>
            </div>

            <div class="form-group" style="margin-bottom: 25px;">
                <label style="display: block; color: #D6F32F; margin-bottom: 8px; font-weight: bold;">Points clés</label>
                <textarea name="liste" rows="6" style="width: 100%; background: #1a1a1a; border: 1px solid #444; color: white; padding: 12px; border-radius: 8px; resize: vertical;">{{ old('liste', is_array($experience->liste) ? implode("\n", $experience->liste) : '') }}</textarea>
            </div>

            <div class="form-group" style="margin-bottom: 30px;">
                <label style="display: block; color: #D6F32F; margin-bottom: 8px; font-weight: bold;">Ajouter des images</label>
                <input type="file" name="new_images[]" multiple style="width: 100%; background: #1a1a1a; border: 1px solid #444; color: white; padding: 12px; border-radius: 8px;">
                
                @if($experience->images && count($experience->images) > 0)
                    <div style="margin-top: 20px;">
                        <p style="font-size: 0.85rem; color: #ff4d4d; margin-bottom: 10px;">Cochez les images à supprimer :</p>
                        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(80px, 1fr)); gap: 15px;">
                            @foreach($experience->images as $img)
                                <div style="position: relative; border: 1px solid #444; padding: 2px; border-radius: 6px;">
                                    <input type="checkbox" name="delete_images[]" value="{{ $img }}" 
                                           style="position: absolute; top: -5px; right: -5px; accent-color: #ff4d4d; z-index: 2; cursor: pointer;">
                                    <img src="{{ Vite::asset('resources/images/experiences/' . $experience->folder_name . '/' . $img) }}" 
                                         style="width: 100%; height: 60px; object-fit: cover; border-radius: 4px;">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="btn-submit-container" style="margin-top: 40px; display: flex; gap: 20px; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 30px;">
                <button type="submit" class="btn-neon-pill">Enregistrer les modifications</button>
                <a href="{{ route('admin.experiences.index') }}" style="color: #aaa; text-decoration: none; padding: 12px; font-weight: bold; display: flex; align-items: center;">
                    Annuler
                </a>
            </div>

        </form>
    </div>
</div>
@endsection
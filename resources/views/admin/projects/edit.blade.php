@extends('layouts.app')

@section('content')
<style>
    /* CSS RESPONSIVE IDENTIQUE AUX AUTRES PAGES ADMIN */
    @media (max-width: 768px) {
        .admin-content-wrapper { padding: 80px 15px 40px 15px !important; }
        .admin-header-actions { flex-direction: column; gap: 20px; align-items: flex-start !important; }
        .admin-form-grid { grid-template-columns: 1fr !important; gap: 15px !important; }
        .btn-submit-container { flex-direction: column !important; }
        .btn-neon-pill { width: 100% !important; text-align: center; justify-content: center; }
        .image-delete-grid { grid-template-columns: repeat(auto-fill, minmax(80px, 1fr)) !important; }
    }

    /* Style miniature delete */
    .img-delete-wrapper { position: relative; border: 1px solid #444; padding: 2px; border-radius: 6px; }
    .delete-checkbox { position: absolute; top: -5px; right: -5px; accent-color: #ff4d4d; width: 20px; height: 20px; cursor: pointer; z-index: 2; }
</style>

<div class="admin-content-wrapper" style="padding: 40px; color: white; background: #0a0a0a; min-height: 100vh;">
    
    <div class="admin-header-actions" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h1 class="admin-page-title" style="color: #D6F32F; margin: 0;">Modifier : {{ $project->title }}</h1>
        <a href="{{ route('admin.projects.index') }}" class="btn-neon-pill" style="text-decoration: none; background: #333; color: white; padding: 10px 20px; border-radius: 50px; border: 1px solid #555;">
            ← Retour
        </a>
    </div>

    <div class="admin-form-container" style="background: rgba(255,255,255,0.05); padding: 30px; border-radius: 15px; border: 1px solid rgba(255,255,255,0.1); max-width: 900px; margin: 5rem auto;">
        
        <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <h3 style="color: #D6F32F; border-bottom: 1px solid #333; padding-bottom: 10px; margin-bottom: 20px;">Informations Générales</h3>
            
            <div class="admin-form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px;">
                <div class="form-group">
                    <label style="display: block; color: #aaa; margin-bottom: 8px;">Titre</label>
                    <input type="text" name="title" value="{{ old('title', $project->title) }}" 
                           style="width: 100%; background: #1a1a1a; border: 1px solid #444; color: white; padding: 12px; border-radius: 8px;" required>
                </div>

                <div class="form-group">
                    <label style="display: block; color: #aaa; margin-bottom: 8px;">Catégorie</label>
                    <input type="text" name="category" value="{{ old('category', $project->category) }}" 
                           style="width: 100%; background: #1a1a1a; border: 1px solid #444; color: white; padding: 12px; border-radius: 8px;" required>
                </div>
            </div>

            <div class="admin-form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px;">
                <div class="form-group">
                    <label style="display: block; color: #aaa; margin-bottom: 8px;">Sous-titre (ex: Date / Client)</label>
                    <input type="text" name="subtitle" value="{{ old('subtitle', $project->subtitle) }}" 
                           style="width: 100%; background: #1a1a1a; border: 1px solid #444; color: white; padding: 12px; border-radius: 8px;">
                </div>

                <div class="form-group">
                    <label style="display: block; color: #aaa; margin-bottom: 8px;">Dossier Images (Folder Name)</label>
                    <input type="text" name="folder_name" value="{{ old('folder_name', $project->folder_name) }}" 
                           style="width: 100%; background: #1a1a1a; border: 1px solid #444; color: white; padding: 12px; border-radius: 8px;" required>
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 25px;">
                <label style="display: block; color: #aaa; margin-bottom: 8px;">Description Complète</label>
                <textarea name="description" rows="6" style="width: 100%; background: #1a1a1a; border: 1px solid #444; color: white; padding: 12px; border-radius: 8px; resize: vertical;" required>{{ old('description', $project->description) }}</textarea>
            </div>

            <h3 style="color: #D6F32F; border-bottom: 1px solid #333; padding-bottom: 10px; margin-bottom: 20px; margin-top: 40px;">Détails & Équipe</h3>

            <div class="admin-form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px;">
                <div class="form-group">
                    <label style="display: block; color: #aaa; margin-bottom: 8px;">Technologies (séparées par virgules)</label>
                    <input type="text" name="technologies" 
                           value="{{ old('technologies', is_array($project->technologies) ? implode(', ', $project->technologies) : $project->technologies) }}" 
                           placeholder="HTML, CSS, Laravel..."
                           style="width: 100%; background: #1a1a1a; border: 1px solid #444; color: white; padding: 12px; border-radius: 8px;">
                </div>

                <div class="form-group">
                    <label style="display: block; color: #aaa; margin-bottom: 8px;">Collaborateurs (séparés par virgules)</label>
                    <input type="text" name="collaborators" 
                           value="{{ old('collaborators', is_array($project->collaborators) ? implode(', ', $project->collaborators) : $project->collaborators) }}" 
                           placeholder="Pierre, Paul, Jacques..."
                           style="width: 100%; background: #1a1a1a; border: 1px solid #444; color: white; padding: 12px; border-radius: 8px;">
                </div>
            </div>

            <h3 style="color: #D6F32F; border-bottom: 1px solid #333; padding-bottom: 10px; margin-bottom: 20px; margin-top: 40px;">Liens Externes</h3>

            <div class="admin-form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px;">
                <div class="form-group">
                    <label style="display: block; color: #aaa; margin-bottom: 8px;">Site Live (URL)</label>
                    <input type="text" name="link_live" value="{{ old('link_live', $project->link_live) }}" 
                           style="width: 100%; background: #1a1a1a; border: 1px solid #444; color: white; padding: 12px; border-radius: 8px;">
                </div>
                <div class="form-group">
                    <label style="display: block; color: #aaa; margin-bottom: 8px;">GitHub (URL)</label>
                    <input type="text" name="link_github" value="{{ old('link_github', $project->link_github) }}" 
                           style="width: 100%; background: #1a1a1a; border: 1px solid #444; color: white; padding: 12px; border-radius: 8px;">
                </div>
            </div>
            
            <div class="admin-form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px;">
                <div class="form-group">
                    <label style="display: block; color: #aaa; margin-bottom: 8px;">Google Drive (URL)</label>
                    <input type="text" name="link_drive" value="{{ old('link_drive', $project->link_drive) }}" 
                           style="width: 100%; background: #1a1a1a; border: 1px solid #444; color: white; padding: 12px; border-radius: 8px;">
                </div>
                <div class="form-group">
                    <label style="display: block; color: #aaa; margin-bottom: 8px;">Vidéo Intro (URL)</label>
                    <input type="text" name="link_video_intro" value="{{ old('link_video_intro', $project->link_video_intro) }}" 
                           style="width: 100%; background: #1a1a1a; border: 1px solid #444; color: white; padding: 12px; border-radius: 8px;">
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 25px;">
                <label style="display: block; color: #aaa; margin-bottom: 8px;">Vidéo Démo (URL)</label>
                <input type="text" name="link_video" value="{{ old('link_video', $project->link_video) }}" 
                       style="width: 100%; background: #1a1a1a; border: 1px solid #444; color: white; padding: 12px; border-radius: 8px;">
            </div>

            <h3 style="color: #D6F32F; border-bottom: 1px solid #333; padding-bottom: 10px; margin-bottom: 20px; margin-top: 40px;">Médias</h3>

            <div class="form-group" style="margin-bottom: 30px; background: rgba(0,0,0,0.2); padding: 15px; border-radius: 10px;">
                <label style="display: block; color: #fff; margin-bottom: 10px; font-weight: bold;">Image de Couverture (Hero)</label>
                
                @if($project->thumbnail)
                    <div style="margin-bottom: 15px; display: flex; align-items: center; gap: 15px;">
                        <img src="{{ Vite::asset('resources/images/projects/' . $project->folder_name . '/' . $project->thumbnail) }}" 
                             style="width: 150px; height: 80px; object-fit: cover; border-radius: 6px; border: 1px solid #444;">
                        
                        <label style="display: flex; align-items: center; gap: 8px; color: #ff4d4d; cursor: pointer;">
                            <input type="checkbox" name="delete_thumbnail" value="1">
                            Supprimer l'image actuelle
                        </label>
                    </div>
                @endif
                
                <input type="file" name="thumbnail" style="width: 100%; background: #1a1a1a; border: 1px solid #444; color: white; padding: 10px; border-radius: 8px;">
                <small style="color: #666;">Laisser vide pour ne pas changer.</small>
            </div>

            <div class="form-group" style="margin-bottom: 30px;">
                <label style="display: block; color: #fff; margin-bottom: 10px; font-weight: bold;">Galerie d'Images</label>
                
                <input type="file" name="new_gallery[]" multiple style="width: 100%; background: #1a1a1a; border: 1px solid #444; color: white; padding: 10px; border-radius: 8px;">
                <small style="color: #666; margin-bottom: 15px; display: block;">Ajouter de nouvelles images.</small>
                
                @if($project->gallery && count($project->gallery) > 0)
                    <p style="font-size: 0.85rem; color: #ff4d4d; margin-bottom: 10px;">Cochez pour supprimer :</p>
                    <div class="image-delete-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); gap: 15px;">
                        @foreach($project->gallery as $img)
                            <div class="img-delete-wrapper">
                                <input type="checkbox" name="delete_gallery_images[]" value="{{ $img }}" class="delete-checkbox">
                                <img src="{{ Vite::asset('resources/images/projects/' . $project->folder_name . '/' . $img) }}" 
                                     style="width: 100%; height: 80px; object-fit: cover; border-radius: 4px;">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="btn-submit-container" style="margin-top: 40px; display: flex; gap: 20px; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 30px;">
                <button type="submit" class="btn-neon-pill" style="cursor: pointer; background: #D6F32F; color: black; border: none; padding: 12px 30px; border-radius: 50px; font-weight: bold; font-size: 1rem;">
                    Enregistrer les modifications
                </button>
                <a href="{{ route('admin.projects.index') }}" style="color: #aaa; text-decoration: none; padding: 12px; font-weight: bold; display: flex; align-items: center;">
                    Annuler
                </a>
            </div>

        </form>
    </div>
</div>
@endsection
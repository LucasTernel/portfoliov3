@extends('layouts.app')

@section('content')
<div class="admin-content-wrapper center-content">
    
    <div class="admin-form-card">
        <h1 class="admin-form-title">Nouveau Projet</h1>

        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group-row">
                <div class="form-group">
                    <label>Titre du Projet</label>
                    <input type="text" name="title" class="admin-input" placeholder="ex: Portfolio 2024" required>
                </div>
                <div class="form-group">
                    <label>Catégorie</label>
                    <input type="text" name="category" class="admin-input" placeholder="ex: Web Design, Fullstack..." required>
                </div>
            </div>

            <div class="form-group-row">
                <div class="form-group">
                    <label>Sous-titre</label>
                    <input type="text" name="subtitle" class="admin-input" placeholder="ex: Refonte complète...">
                </div>
                <div class="form-group">
                    <label>Technologies (séparées par virgules)</label>
                    <input type="text" name="technologies" class="admin-input" placeholder="Laravel, VueJS, Figma">
                </div>
            </div>

            <div class="form-group">
                <label>Collaborateurs (Optionnel)</label>
                <input type="text" name="collaborators" class="admin-input" placeholder="ex: Jean Dupont, Marie Curie (séparés par virgules)">
                <small style="color:#666; font-size: 0.8rem;">Laissez vide si projet solo.</small>
            </div>

            <div class="form-group" style="background: #111; padding: 20px; border-radius: 10px; border: 1px solid #333; margin: 30px 0;">
                <label style="color:#D6F32F; margin-bottom:15px; display:block; text-transform:uppercase;">🔗 Liens & Ressources</label>
                
                <div class="form-group-row">
                    <div class="form-group">
                        <label>Lien GitHub</label>
                        <input type="url" name="link_github" class="admin-input" placeholder="https://github.com/...">
                    </div>
                    <div class="form-group">
                        <label>Lien Site (Live)</label>
                        <input type="url" name="link_live" class="admin-input" placeholder="https://monsite.com">
                    </div>
                </div>

                <div class="form-group-row">
                    <div class="form-group">
                        <label>Google Drive / Docs</label>
                        <input type="url" name="link_drive" class="admin-input" placeholder="https://drive.google.com/...">
                    </div>
                    <div class="form-group">
                        <label>Vidéo Présentation (Intro)</label>
                        <input type="url" name="link_video_intro" class="admin-input" placeholder="Lien YouTube/Vimeo...">
                    </div>
                </div>

                <div class="form-group">
                    <label>Autre Vidéo (Démo)</label>
                    <input type="url" name="link_video" class="admin-input" placeholder="Lien vidéo supplémentaire...">
                </div>
            </div>

            <div class="form-group">
                <label>Description Courte (Intro)</label>
                <textarea name="short_description" class="admin-input" rows="2" placeholder="Accroche visible sur la home..."></textarea>
            </div>

            <div class="form-group">
                <label>Description Complète</label>
                <textarea name="description" class="admin-input" rows="5" required placeholder="Détails du projet..."></textarea>
            </div>

            <div class="form-group-row">
                <div class="form-group">
                    <label>Image de Couverture (Thumbnail)</label>
                    <div class="file-upload-wrapper">
                        <input type="file" name="thumbnail_file" id="thumb_input" class="admin-file-input">
                        <label for="thumb_input" class="btn-file-custom">Choisir une Une</label>
                        <span id="thumb-name" style="color:#666; font-size:0.8rem; margin-left:10px;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label>Galerie d'images</label>
                    <div class="file-upload-wrapper">
                        <input type="file" name="gallery_files[]" id="gallery_input" multiple class="admin-file-input">
                        <label for="gallery_input" class="btn-file-custom">Ajouter photos</label>
                        <span id="gallery-count" style="color:#666; font-size:0.8rem; margin-left:10px;"></span>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.projects.index') }}" class="btn-cancel">Annuler</a>
                <button type="submit" class="btn-neon-pill">Enregistrer le Projet</button>
            </div>
        </form>
    </div>

</div>

<script>
    // Script pour afficher le nom des fichiers sélectionnés
    document.getElementById('gallery_input').addEventListener('change', function(e) {
        document.getElementById('gallery-count').textContent = e.target.files.length + ' fichiers';
    });
    document.getElementById('thumb_input').addEventListener('change', function(e) {
        if(e.target.files.length > 0) {
            document.getElementById('thumb-name').textContent = e.target.files[0].name;
        }
    });
</script>
@endsection
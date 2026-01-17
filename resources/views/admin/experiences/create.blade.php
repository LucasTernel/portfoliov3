@extends('layouts.app')

@section('content')
<div class="admin-content-wrapper center-content">
    
    <div class="admin-form-card">
        <h1 class="admin-form-title">Nouvelle Expérience</h1>

        <form action="{{ route('admin.experiences.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group-row">
                <div class="form-group">
                    <label>Entreprise / Titre</label>
                    <input type="text" name="title" class="admin-input" placeholder="ex: Agence Digital" required>
                </div>
                <div class="form-group">
                    <label>Rôle</label>
                    <input type="text" name="role" class="admin-input" placeholder="ex: Lead Dev Front" required>
                </div>
            </div>

            <div class="form-group">
                <label>Période (Date Range)</label>
                <input type="text" name="date_range" class="admin-input" placeholder="ex: Sept 2023 - Aujourd'hui" required>
            </div>

            <div class="form-group">
                <label>Description Globale</label>
                <textarea name="description" class="admin-input" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label>Liste des tâches (1 ligne = 1 point)</label>
                <textarea name="liste_input" class="admin-input" rows="5" placeholder="- Développement de composants Vue.js&#10;- Gestion de la base de données&#10;- Déploiement CI/CD"></textarea>
                <small style="color: #666; font-size: 0.8rem;">Sautez une ligne pour créer un nouveau point dans la liste.</small>
            </div>

            <div class="form-group">
                <label>Galerie d'images</label>
                <div class="file-upload-wrapper">
                    <input type="file" name="images_files[]" id="images_files" multiple class="admin-file-input">
                    <label for="images_files" class="btn-file-custom">Choisir des fichiers</label>
                    <span id="file-count" style="color:white; margin-left:10px;">Aucun fichier</span>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.experiences.index') }}" class="btn-cancel">Annuler</a>
                <button type="submit" class="btn-neon-pill">Enregistrer</button>
            </div>
        </form>
    </div>

</div>

<script>
    document.getElementById('images_files').addEventListener('change', function(e) {
        var count = e.target.files.length;
        document.getElementById('file-count').textContent = count + ' fichier(s) sélectionné(s)';
    });
</script>
@endsection
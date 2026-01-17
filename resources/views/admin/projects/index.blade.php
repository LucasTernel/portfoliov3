@extends('layouts.app')

@section('content')
<div class="admin-content-wrapper">
    
    <div class="admin-header-actions">
        <h1 class="admin-page-title">Mes Projets</h1>
        <a href="{{ route('admin.projects.create') }}" class="btn-neon-pill">+ Nouveau Projet</a>
    </div>

    <div class="admin-list-grid">
        @foreach($projects as $project)
            <div class="admin-item-card">
                <div class="item-info">
                    <h3>
                        {{ $project->title }} 
                        <span style="font-size:0.8rem; color: white; background: #333; padding: 2px 8px; border-radius: 4px; margin-left: 10px; vertical-align: middle;">
                            {{ $project->category }}
                        </span>
                    </h3>
                    
                    <span class="item-sub">{{ $project->subtitle }}</span>

                    <div style="margin-top: 8px; font-size: 0.8rem; color: #666;">
                        <span style="color: #aaa;">Tech: {{ is_array($project->technologies) ? implode(', ', $project->technologies) : '' }}</span>
                        <br>
                        <span>📂 {{ $project->folder_name }}</span> | 
                        <span>🖼 Galerie: {{ is_array($project->gallery) ? count($project->gallery) : 0 }} img</span>
                    </div>
                </div>

                <div class="card-actions" style="display: flex; align-items: center; gap: 10px; margin-top: 15px; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 15px; justify-content: flex-end;">
    
                <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn-edit-icon" title="Modifier"
                style="display: flex; justify-content: center; align-items: center; width: 40px; height: 40px; background: #333; color: #D6F32F; border-radius: 50%; text-decoration: none; border: 1px solid #D6F32F; font-size: 1.2rem;">
                    ✏️  
                </a>

                <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Supprimer ce projet ?');" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-delete-icon" 
                            style="display: flex; justify-content: center; align-items: center; width: 40px; height: 40px; background: #333; color: #ff4d4d; border-radius: 50%; border: 1px solid #ff4d4d; cursor: pointer; font-size: 1rem;">
                        ✖
                    </button>
                </form>
            </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
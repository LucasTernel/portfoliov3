@extends('layouts.app')

@section('content')
<div class="admin-content-wrapper">
    
    <div class="admin-header-actions">
        <h1 class="admin-page-title">Mes Expériences</h1>
        <a href="{{ route('admin.experiences.create') }}" class="btn-neon-pill">+ Ajouter</a>
    </div>

    <div class="admin-list-grid">
        @foreach($experiences as $exp)
            <div class="admin-item-card">
                <div class="item-info">
                    <h3>{{ $exp->title }} <span style="color:white; font-size:0.8em;">— {{ $exp->role }}</span></h3>
                    
                    <span class="item-sub">{{ $exp->date_range }}</span>
                    
                    <div style="margin-top: 5px; font-size: 0.8rem; color: #666;">
                        <span>📂 {{ $exp->folder_name }}</span> | 
                        <span>🖼 {{ is_array($exp->images) ? count($exp->images) : 0 }} images</span>
                    </div>
                </div>

                <div class="card-actions" style="display: flex; align-items: center; gap: 10px;">
                <a href="{{ route('admin.experiences.edit', $exp->id) }}" class="btn-edit-icon" title="Modifier">
                    ✏️
                </a>

                <form action="{{ route('admin.experiences.destroy', $exp) }}" method="POST" onsubmit="return confirm('Supprimer cette expérience ?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-delete-icon">✖</button>
                </form>
            </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
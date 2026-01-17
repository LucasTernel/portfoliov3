@extends('layouts.app')

@section('content')

<div class="project-hero">
    @if($project->thumbnail)
        <img src="{{ Vite::asset('resources/images/projects/' . $project->folder_name . '/' . $project->thumbnail) }}" 
             alt="{{ $project->title }}" class="hero-bg">
    @endif
    <div class="hero-overlay"></div>
    
    <div class="hero-content">
        <span class="hero-category">{{ $project->category }}</span>
        <h1 class="hero-title">{{ $project->title }}</h1>
        @if($project->subtitle)
            <p class="hero-subtitle">{{ $project->subtitle }}</p>
        @endif
    </div>
</div>

<div class="project-container">

    <div class="project-sidebar">
        
        @if($project->technologies && count($project->technologies) > 0)
            <div class="sidebar-block">
                <h3>Technologies</h3>
                <div class="tech-list">
                    @foreach($project->technologies as $tech)
                        <span class="tech-tag">{{ $tech }}</span>
                    @endforeach
                </div>
            </div>
        @endif

        @if($project->collaborators && count($project->collaborators) > 0)
            <div class="sidebar-block">
                <h3>Collaborateurs</h3>
                <ul class="collab-list">
                    @foreach($project->collaborators as $collab)
                        <li class="collab-item">👤 {{ $collab }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="sidebar-block">
            <h3>Liens</h3>
            <div class="project-links">
                
                {{-- Lien Site Live (Principal) --}}
                @if($project->link_live)
                    <a href="{{ $project->link_live }}" target="_blank" class="btn-link-primary">
                        Voir le site <i class="fas fa-arrow-right"></i>
                    </a>
                @endif

                {{-- Lien GitHub --}}
                @if($project->link_github)
                    <a href="{{ $project->link_github }}" target="_blank" class="btn-link-secondary">
                        <i class="fab fa-github"></i> Code Source
                    </a>
                @endif

                {{-- Lien Drive --}}
                @if($project->link_drive)
                    <a href="{{ $project->link_drive }}" target="_blank" class="btn-link-secondary">
                        <i class="fab fa-google-drive"></i> Dossier Drive
                    </a>
                @endif

                {{-- Vidéo Présentation --}}
                @if($project->link_video_intro)
                    <a href="{{ $project->link_video_intro }}" target="_blank" class="btn-link-secondary">
                        <i class="fas fa-play-circle"></i> Présentation
                    </a>
                @endif

                {{-- Vidéo Démo --}}
                @if($project->link_video)
                    <a href="{{ $project->link_video }}" target="_blank" class="btn-link-secondary">
                        <i class="fas fa-video"></i> Démo Vidéo
                    </a>
                @endif

            </div>
        </div>
        
        <a href="{{ route('projects') }}" class="back-link">← Retour aux projets</a>
    </div>

    <div class="project-content">
        
        <div class="description-box">
            <h2>À propos du projet</h2>
            <div class="text-body">
                {!! nl2br(e($project->description)) !!}
            </div>
        </div>

        @if($project->gallery && count($project->gallery) > 0)
            <div class="gallery-section">
                <h2>Galerie</h2>
                <div class="public-gallery-grid">
                    @foreach($project->gallery as $img)
                        <div class="gallery-img-wrapper">
                            <img src="{{ Vite::asset('resources/images/projects/' . $project->folder_name . '/' . $img) }}" 
                                 alt="Galerie {{ $project->title }}" loading="lazy">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>

</div>
@endsection
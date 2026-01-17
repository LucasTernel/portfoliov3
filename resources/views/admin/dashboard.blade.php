@extends('layouts.app')

@section('content')

    <header class="admin-header">
        <div class="logo">
            <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="Logo Lucas Ternel">
        </div>

        <div class="contact-indicator">
            @if($unreadContactsCount > 0)
                <div class="green-dot"></div>
                <span class="contact-text" style="color: #D6F32F; font-weight: bold;">
                    {{ $unreadContactsCount }} Nouveau(x) Message(s)
                </span>
            @else
                <span class="contact-text" style="color: #666;">
                    Aucun nouveau message
                </span>
            @endif
        </div>
    </header>

    <div class="admin-main-overlay">
        
        <div class="admin-text-content">
            <h1 class="admin-welcome">Bienvenue Lucas</h1>

            <div class="admin-stats-group">
                
                <div class="stat-row">
                    <span class="stat-val">{{ $projectsCount }}</span>
                    <span class="stat-lbl">Projets</span>
                </div>
                
                <div class="stat-row">
                    <span class="stat-val">{{ $totalContactsCount }}</span>
                    <span class="stat-lbl">Contacts Reçus</span>
                </div>
                
            </div>

            <div class="admin-actions-row">
                <a href="{{ route('home') }}" class="btn-neon-pill">Retour a l'Accueil</a>
                
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-neon-pill">Deconnexion</button>
                </form>
            </div>
        </div>

    </div>

@endsection
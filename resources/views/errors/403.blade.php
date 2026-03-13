@extends('layouts.app')

@section('title', '403 - Accès Refusé | Lucas Ternel')

@section('content')
<div class="error-page-wrapper">
    <div class="error-content">
        
        <a href="{{ route('home') }}" class="error-logo-link">
            <img src="{{ asset('images/logo.png') }}" alt="Lucas Ternel" class="error-logo">
        </a>

        <h1 class="error-code" style="color: #ff9800; text-shadow: 0 0 30px rgba(255, 152, 0, 0.2);">403</h1>
        
        <h2 class="error-message">Accès Interdit</h2>
        
        <p class="error-description">
            Désolé, vous n'avez pas les permissions nécessaires pour accéder à cette page.<br>
            C'est une zone réservée au personnel autorisé.
        </p>

        <a href="{{ route('home') }}" class="btn-error-home">
            <span>← Retour en zone sûre</span>
        </a>
    </div>
</div>
@endsection
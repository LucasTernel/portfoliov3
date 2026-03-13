@extends('layouts.app')

@section('title', 'Erreur 500 - Erreur Serveur | Lucas Ternel')

@section('content')
<div class="error-page-wrapper">
    <div class="error-content">
        
        <a href="{{ route('home') }}" class="error-logo-link">
            <img src="{{ asset('images/logo.png') }}" alt="Lucas Ternel" class="error-logo">
        </a>

        <h1 class="error-code" style="color: #F32F2F; text-shadow: 0 0 30px rgba(243, 47, 47, 0.2);">500</h1>
        
        <h2 class="error-message">Oups ! Un boulon a sauté.</h2>
        
        <p class="error-description">
            Nos serveurs ont rencontré un problème interne inattendu.<br>
            Pas de panique, notre équipe a été notifiée automatiquement.
        </p>

        <a href="{{ route('home') }}" class="btn-error-home">
            <span>← Réessayer l'accueil</span>
        </a>
    </div>
</div>
@endsection
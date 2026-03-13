@extends('layouts.app')

@section('title', '404 - Page non trouvée | Lucas Ternel')

@section('content')
<div class="error-page-wrapper">
    <div class="error-content">
        
        <a href="{{ route('home') }}" class="error-logo-link">
            <img src="{{ asset('images/logo.png') }}" alt="Lucas Ternel" class="error-logo">
        </a>

        <h1 class="error-code">404</h1>
        
        <h2 class="error-message">Oups ! Perdu dans le code ?</h2>
        
        <p class="error-description">
            La page que vous cherchez a peut-être été déplacée, supprimée ou n'a jamais existé.
        </p>

        <a href="{{ route('home') }}" class="btn-error-home">
            <span>← Retour à l'accueil</span>
        </a>
    </div>
</div>
@endsection
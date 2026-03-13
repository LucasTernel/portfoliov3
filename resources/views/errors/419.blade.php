@extends('layouts.app')

@section('title', '419 - Page Expirée | Lucas Ternel')

@section('content')
<div class="error-page-wrapper">
    <div class="error-content">
        
        <a href="{{ route('home') }}" class="error-logo-link">
            <img src="{{ asset('images/logo.png') }}" alt="Lucas Ternel" class="error-logo">
        </a>

        <h1 class="error-code">419</h1>
        
        <h2 class="error-message">Session Expirée</h2>
        
        <p class="error-description">
            Vous êtes resté inactif trop longtemps.<br>
            Veuillez rafraîchir la page pour continuer.
        </p>

        <a href="javascript:window.location.reload()" class="btn-error-home">
            <span>Actualiser la page ↻</span>
        </a>
    </div>
</div>
@endsection
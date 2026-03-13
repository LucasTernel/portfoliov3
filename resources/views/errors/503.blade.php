@extends('layouts.app')

@section('title', 'Maintenance en cours | Lucas Ternel')

@section('content')
<div class="error-page-wrapper">
    <div class="error-content">
        
        <img src="{{ asset('images/logo.png') }}" alt="Lucas Ternel" class="error-logo">

        <h1 class="error-code">503</h1>
        
        <h2 class="error-message">Mise à jour en cours</h2>
        
        <p class="error-description" style = "margin-bottom: 0px !important">
            Je suis actuellement en train d'améliorer le site.<br>
            L'accès est temporairement restreint, mais je reviens très vite.
        </p>
        <div style="display : flex; flex-direction : row ; align-items: center; gap : 20px;">
            <div style="margin-bottom: 40px; padding-top: 20px; display: inline-block;">
                <p style="color: #666; font-size: 0.9rem; margin-bottom: 5px; text-transform: uppercase; letter-spacing: 1px;">Urgence ?</p>
                <a href="mailto:contact@lucasternel.com" style="color: white; text-decoration: none; border-bottom: 1px solid #D6F32F; padding-bottom: 3px; font-size: 1.1rem; transition: 0.3s;">
                    contact@lucasternel.com
                </a>
            </div>
            <br>

            <a href="javascript:window.location.reload()" class="btn-error-home">
                <span>Actualiser la page ↻</span>
            </a>
        </div>
    </div>
</div>
@endsection
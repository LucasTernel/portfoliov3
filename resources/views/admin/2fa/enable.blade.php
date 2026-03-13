@extends('layouts.app')

@section('title', 'Créer le 2FA - Lucas Ternel')

@section('content')
<div class="two-fa-container">
    <div class="two-fa-card">
        <h2 class="two-fa-title">Activer la Double Authentification</h2>
        
        <p class="two-fa-desc">
            Ouvrez votre application <strong>Google Authenticator</strong> (ou Authy) et scannez le QR Code ci-dessous.
        </p>
        
        <div class="two-fa-qr-box">
            {!! $QR_Image !!}
        </div>
        
        <div class="two-fa-secret-area">
            <p>Impossible de scanner ?</p>
            <span class="two-fa-code">{{ $secret }}</span>
        </div>

        <form action="{{ route('2fa.enable.post') }}" method="POST" class="two-fa-form">
            @csrf
            <div class="two-fa-group">
                <input type="text" 
                       name="one_time_password" 
                       placeholder="Code à 6 chiffres" 
                       class="two-fa-input" 
                       inputmode="numeric" 
                       pattern="[0-9]*"
                       autocomplete="one-time-code"
                       required>
            </div>
            
            <button type="submit" class="two-fa-btn">
                Valider et Activer
            </button>
        </form>
    </div>
</div>
@endsection
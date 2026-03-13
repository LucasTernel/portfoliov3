@extends('layouts.app')

@section('title', 'Connexion 2FA - Lucas Ternel')

@section('content')
<div class="two-fa-container">
    <div class="two-fa-card">
        <h2 class="two-fa-title">Double Authentification</h2>
        
        <p class="two-fa-desc">
            Sécurité requise. Veuillez entrer le code à 6 chiffres de votre application.
        </p>

        <form method="POST" action="{{ route('2fa.verify') }}" class="two-fa-form">
            @csrf
            
            <div class="two-fa-group">
                <input type="text" 
                       name="one_time_password" 
                       class="two-fa-input" 
                       required 
                       autofocus 
                       placeholder="000 000"
                       inputmode="numeric" 
                       pattern="[0-9]*" 
                       autocomplete="one-time-code">
            </div>

            <button type="submit" class="two-fa-btn">Vérifier</button>
        </form>
    </div>
</div>
@endsection
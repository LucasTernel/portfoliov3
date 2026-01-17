@extends('layouts.app')

@section('title', 'Me Contacter | Lucas Ternel')

@section('content')

<div class="contact-page-wrapper">
    
    <div class="contact-container">
        
        <div class="contact-info">
            <h1 class="contact-title">Discutons de <br><span style="color:#D6F32F;">votre projet.</span></h1>
            
            <p class="contact-desc">
                Une idée ? Un besoin technique ? <br>
                Je suis disponible pour en parler. Réponse sous 24h garantie.
            </p>

            <div class="info-row">
                <span>📧</span>
                <a href="mailto:contact@lucasternel.com" style="color:white; text-decoration:none; border-bottom:1px solid #333;">contact@lucasternel.com</a>
            </div>
            
            <div class="info-row">
                <span>📍</span>
                <span>France</span>
            </div>

            <div class="neon-divider"></div>
        </div>

        <div class="contact-form-card">
            
            @if(session('success'))
                <div style="background: rgba(0, 255, 0, 0.1); color: #4ade80; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid rgba(0,255,0,0.2);">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('contact.send') }}" method="POST">
                @csrf
                
                <div style="display: none;">
                    <input type="text" name="bot_field" tabindex="-1" autocomplete="off">
                </div>

                <div>
                    <label class="input-label">Nom complet</label>
                    <input type="text" name="name" class="input-public" placeholder="Votre nom" required value="{{ old('name') }}">
                </div>

                <div>
                    <label class="input-label">Adresse Email</label>
                    <input type="email" name="email" class="input-public" placeholder="exemple@mail.com" required value="{{ old('email') }}">
                </div>

                <div>
                    <label class="input-label">Sujet (Optionnel)</label>
                    <input type="text" name="subject" class="input-public" placeholder="Demande de devis..." value="{{ old('subject') }}">
                </div>

                <div>
                    <label class="input-label">Message</label>
                    <textarea name="message" rows="3" class="input-public" placeholder="Dites-moi tout..." required>{{ old('message') }}</textarea>
                </div>

                <button type="submit" class="btn-neon-pill" style="width:100%;">Envoyer le message 🚀</button>
            </form>
        </div>

    </div>
</div>
@endsection
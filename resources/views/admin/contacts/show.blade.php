@extends('layouts.app')

@section('content')
<div class="admin-content-wrapper center-content">
    
    <div class="admin-form-card" style="max-width: 800px;">
        <div style="border-bottom: 1px solid #333; padding-bottom: 20px; margin-bottom: 20px;">
            <a href="{{ route('admin.contacts.index') }}" style="color:#888; text-decoration:none;">← Retour</a>
            <h2 style="margin-top:10px; color:#D6F32F;">{{ $contact->subject ?? 'Sans sujet' }}</h2>
            <div style="color:#aaa; font-size: 0.9rem;">
                De : <strong>{{ $contact->name }}</strong> ({{ $contact->email }})<br>
                Reçu le : {{ $contact->created_at->format('d/m/Y à H:i') }}
            </div>
        </div>

        <div style="background: #1a1a1a; padding: 20px; border-radius: 8px; line-height: 1.6; white-space: pre-wrap; margin-bottom: 30px;">{{ $contact->message }}</div>

        @if($contact->replied_at)
            <div style="background: rgba(0, 255, 0, 0.1); border: 1px solid green; padding: 15px; border-radius: 8px; color: #8f8;">
                ✅ Vous avez répondu le {{ $contact->replied_at->format('d/m/Y à H:i') }}
            </div>
        @else
            <h3 style="margin-bottom: 15px;">Répondre maintenant</h3>
            <form action="{{ route('admin.contacts.reply', $contact->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <textarea name="reply_message" rows="6" class="admin-input" placeholder="Bonjour {{ $contact->name }}, merci pour votre message..."></textarea>
                </div>
                <button type="submit" class="btn-neon-pill">Envoyer la réponse ✉️</button>
            </form>
        @endif

        <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" style="margin-top: 40px; text-align: right;">
            @csrf @method('DELETE')
            <button type="submit" style="background:none; border:none; color:#ff4d4d; cursor:pointer; text-decoration:underline;" onclick="return confirm('Supprimer ce message ?')">Supprimer définitivement</button>
        </form>
    </div>
</div>
@endsection
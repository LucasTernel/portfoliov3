@extends('layouts.app')

@section('content')
<div class="admin-content-wrapper">
    <h1 class="admin-page-title">Messagerie</h1>
    
    <div class="projects-list-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>État</th>
                    <th>Date</th>
                    <th>Nom</th>
                    <th>Sujet</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $contact)
                    <tr style="{{ !$contact->is_read ? 'background: rgba(214, 243, 47, 0.05);' : '' }}">
                        <td>
                            @if($contact->replied_at)
                                <span class="badge-category" style="background:#222; border:1px solid #D6F32F; color:#D6F32F;">RÉPONDU</span>
                            @elseif(!$contact->is_read)
                                <span class="badge-category" style="background:#D6F32F; color:black;">NOUVEAU</span>
                            @else
                                <span class="badge-category" style="background:#333; color:#888;">LU</span>
                            @endif
                        </td>
                        <td style="color:#888;">{{ $contact->created_at->format('d/m H:i') }}</td>
                        <td style="font-weight:bold;">{{ $contact->name }}</td>
                        <td>{{ Str::limit($contact->subject, 30) ?? 'Pas de sujet' }}</td>
                        <td>
                            <a href="{{ route('admin.contacts.show', $contact->id) }}" class="btn-neon-pill" style="padding: 5px 15px; font-size: 0.8rem;">Lire</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center p-4">Aucun message.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">{{ $contacts->links() }}</div>
    </div>
</div>
@endsection
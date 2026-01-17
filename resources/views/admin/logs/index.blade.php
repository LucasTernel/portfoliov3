@extends('layouts.app')

@section('content')
<div class="admin-content-wrapper">

    <div class="admin-header-actions">
        <div>
            <h1 class="admin-page-title">Journaux d'activité (Logs)</h1>
            <p style="color:#888; margin-top:5px;">Historique des actions sur le site.</p>
        </div>
        
        <a href="{{ route('admin.logs.export') }}" class="btn-neon-pill" style="display:flex; align-items:center; gap:10px;">
            📥 Exporter CSV
        </a>
    </div>

    <div class="projects-list-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Action</th>
                    <th>Description</th>
                    <th>Utilisateur</th>
                    <th>IP</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                    <tr>
                        <td style="color:#666; font-size:0.9rem;">
                            {{ $log->created_at->format('d/m/Y') }}<br>
                            <span style="font-size:0.8rem;">{{ $log->created_at->format('H:i') }}</span>
                        </td>

                        <td>
                            <span style="color: #D6F32F; font-weight:bold;">{{ $log->action }}</span>
                        </td>

                        <td style="color:#ccc;">
                            {{ Str::limit($log->description, 50) }}
                        </td>

                        <td>
                            @if($log->user)
                                <span class="badge-category" style="background:#222; border:1px solid #444;">
                                    👤 {{ $log->user->name }}
                                </span>
                            @else
                                <span style="color:#666; font-style:italic;">Système</span>
                            @endif
                        </td>

                        <td>
                            <span class="ip-badge">{{ $log->ip_address }}</span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center; padding:40px; color:#666;">
                            Aucun historique pour le moment.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top:20px;">
            {{ $logs->links() }}
        </div>
    </div>

</div>
@endsection
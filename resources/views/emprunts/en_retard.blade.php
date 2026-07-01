@extends('layouts.app')
@section('title','Emprunts en retard')
@section('breadcrumb','Emprunts / Retards')
@section('page-title','Emprunts en retard')
@section('content')
@if($emprunts->count())
<div class="alert alert-danger d-flex align-items-center gap-2 mb-3">
    <i class="bi bi-exclamation-triangle-fill"></i>
    <strong>{{ $emprunts->count() }} emprunt(s) en retard</strong> — merci de contacter les adhérents concernés.
</div>
@endif
<div class="tc">
    <div class="th"><span class="fw-semibold" style="font-size:.9rem;color:#991b1b"><i class="bi bi-exclamation-triangle me-2"></i>Retards</span></div>
    @if($emprunts->count())
    <div class="table-responsive">
        <table class="table table-borderless mb-0">
            <thead><tr><th>Livre</th><th>Adhérent</th><th>Emprunté le</th><th>Prévu le</th><th>Jours de retard</th><th>Actions</th></tr></thead>
            <tbody>
            @foreach($emprunts as $e)
            <tr>
                <td style="font-size:.83rem">{{ Str::limit($e->livre->titre,30) }}</td>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        <div class="av" style="background:#fee2e2;color:#991b1b;font-size:.7rem;">{{ strtoupper(substr($e->adherent->prenom,0,1).substr($e->adherent->nom,0,1)) }}</div>
                        <div>
                            <div style="font-size:.83rem;font-weight:600">{{ $e->adherent->prenom }} {{ $e->adherent->nom }}</div>
                            @if($e->adherent->telephone)<div style="font-size:.75rem;color:#64748b">{{ $e->adherent->telephone }}</div>@endif
                        </div>
                    </div>
                </td>
                <td style="font-size:.82rem">{{ $e->date_emprunt->format('d/m/Y') }}</td>
                <td style="font-size:.82rem">{{ $e->date_retour_prevue->format('d/m/Y') }}</td>
                <td><span class="bp bd">{{ now()->diffInDays($e->date_retour_prevue) }} jours</span></td>
                <td>
                    <form method="POST" action="{{ route('emprunts.retour',$e) }}" onsubmit="return confirm('Confirmer le retour ?')">
                        @csrf @method('PATCH')
                        <button class="btn btn-sm btn-success ba"><i class="bi bi-check-circle me-1"></i>Retour</button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @else
        <div class="es"><i class="bi bi-check-circle" style="color:#10b981"></i><h6 style="color:#065f46">Aucun retard !</h6><p>Tous les livres ont été rendus à temps.</p></div>
    @endif
</div>
@endsection

@extends('layouts.app')
@section('title','Fiche adhérent')
@section('breadcrumb','Adhérents / Fiche')
@section('page-title','Fiche Adhérent')
@section('content')
<div class="row g-3">
    <div class="col-md-4">
        <div class="fc p-4 text-center">
            <div class="av mx-auto mb-3" style="width:60px;height:60px;background:#e0f2fe;color:#075985;font-size:1.4rem;">
                {{ strtoupper(substr($adherent->prenom,0,1).substr($adherent->nom,0,1)) }}
            </div>
            <h5 class="fw-bold mb-1">{{ $adherent->prenom }} {{ $adherent->nom }}</h5>
            @if($adherent->statut=='actif')<span class="bp bs">Actif</span>@else<span class="bp bd">Suspendu</span>@endif
            <hr class="my-3">
            <div class="text-start d-flex flex-column gap-2">
                <div><small class="text-muted d-block">Email</small><span style="font-size:.85rem">{{ $adherent->email ?? '—' }}</span></div>
                <div><small class="text-muted d-block">Téléphone</small><span style="font-size:.85rem">{{ $adherent->telephone ?? '—' }}</span></div>
                <div><small class="text-muted d-block">Adresse</small><span style="font-size:.85rem">{{ $adherent->adresse ?? '—' }}</span></div>
                <div><small class="text-muted d-block">Membre depuis</small><span style="font-size:.85rem">{{ $adherent->date_adhesion->format('d/m/Y') }}</span></div>
            </div>
            <div class="d-flex gap-2 mt-3">
                <a href="{{ route('adherents.edit',$adherent) }}" class="btn btn-primary btn-sm flex-fill"><i class="bi bi-pencil me-1"></i>Modifier</a>
                <a href="{{ route('adherents.index') }}" class="btn btn-outline-secondary btn-sm flex-fill">Retour</a>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="tc">
            <div class="th">
                <div class="fw-semibold" style="font-size:.9rem">Historique des emprunts ({{ $adherent->emprunts->count() }})</div>
                <a href="{{ route('emprunts.create') }}?adherent_id={{ $adherent->id }}" class="btn btn-primary btn-sm" style="font-size:.78rem;border-radius:7px;">
                    <i class="bi bi-plus-lg me-1"></i>Nouvel emprunt
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-borderless mb-0">
                    <thead><tr><th>Livre</th><th>Emprunté</th><th>Retour prévu</th><th>Rendu</th><th>Statut</th></tr></thead>
                    <tbody>
                    @forelse($adherent->emprunts()->with('livre')->latest()->get() as $e)
                        <tr>
                            <td style="font-size:.83rem">{{ Str::limit($e->livre->titre,30) }}</td>
                            <td style="font-size:.82rem">{{ $e->date_emprunt->format('d/m/Y') }}</td>
                            <td style="font-size:.82rem">{{ $e->date_retour_prevue->format('d/m/Y') }}</td>
                            <td style="font-size:.82rem">{{ $e->date_retour_effective?$e->date_retour_effective->format('d/m/Y'):'—' }}</td>
                            <td>@if($e->statut=='retourne')<span class="bp bs">Retourné</span>
                                @elseif($e->isEnRetard())<span class="bp bd">En retard</span>
                                @else<span class="bp bw">En cours</span>@endif</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center py-4 text-muted" style="font-size:.85rem">Aucun emprunt</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

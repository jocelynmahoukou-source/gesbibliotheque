@extends('layouts.app')
@section('title','Détail livre')
@section('breadcrumb','Livres / Détail')
@section('page-title','Détail du livre')
@section('content')
<div class="row g-3">
    <div class="col-md-5">
        <div class="fc p-4 text-center">
            <div style="width:80px;height:80px;background:#eef2ff;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:2rem;color:#6366f1;margin:0 auto 1rem;">
                <i class="bi bi-book"></i>
            </div>
            <h5 class="fw-bold">{{ $livre->titre }}</h5>
            <p class="text-muted mb-2">{{ $livre->auteur->prenom }} {{ $livre->auteur->nom }}</p>
            <span class="bp bm">{{ $livre->categorie->nom }}</span>
            <hr class="my-3">
            <div class="row text-start g-2 mt-1">
                <div class="col-6"><small class="text-muted d-block">ISBN</small><span style="font-size:.85rem">{{ $livre->isbn ?? '—' }}</span></div>
                <div class="col-6"><small class="text-muted d-block">Année</small><span style="font-size:.85rem">{{ $livre->annee_publication ?? '—' }}</span></div>
                <div class="col-6"><small class="text-muted d-block">Stock total</small><span style="font-size:.85rem">{{ $livre->quantite }}</span></div>
                <div class="col-6"><small class="text-muted d-block">Disponible</small>
                    @if($livre->quantite_disponible > 0)
                        <span class="bp bs">{{ $livre->quantite_disponible }}</span>
                    @else
                        <span class="bp bd">Épuisé</span>
                    @endif
                </div>
            </div>
            @if($livre->description)
            <hr class="my-3">
            <p style="font-size:.85rem;color:#64748b;text-align:left">{{ $livre->description }}</p>
            @endif
            <div class="d-flex gap-2 mt-3">
                <a href="{{ route('livres.edit',$livre) }}" class="btn btn-primary btn-sm flex-fill"><i class="bi bi-pencil me-1"></i>Modifier</a>
                <a href="{{ route('livres.index') }}" class="btn btn-outline-secondary btn-sm flex-fill">Retour</a>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="tc">
            <div class="th"><div class="fw-semibold" style="font-size:.9rem">Historique des emprunts</div></div>
            <div class="table-responsive">
                <table class="table table-borderless mb-0">
                    <thead><tr><th>Adhérent</th><th>Emprunté le</th><th>Retour prévu</th><th>Statut</th></tr></thead>
                    <tbody>
                    @forelse($livre->emprunts()->with('adherent')->latest()->take(15)->get() as $e)
                        <tr>
                            <td>{{ $e->adherent->prenom }} {{ $e->adherent->nom }}</td>
                            <td>{{ $e->date_emprunt->format('d/m/Y') }}</td>
                            <td>{{ $e->date_retour_prevue->format('d/m/Y') }}</td>
                            <td>@if($e->statut=='retourne')<span class="bp bs">Retourné</span>
                                @elseif($e->isEnRetard())<span class="bp bd">En retard</span>
                                @else<span class="bp bw">En cours</span>@endif</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center py-4 text-muted" style="font-size:.85rem">Aucun emprunt</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

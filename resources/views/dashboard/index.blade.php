@extends('layouts.app')
@section('title','Tableau de bord')
@section('breadcrumb','Tableau de bord')
@section('page-title','Tableau de bord')

@section('content')
{{-- Stats Row --}}
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="sc">
            <div class="sic" style="background:#eef2ff;color:#6366f1;"><i class="bi bi-journals"></i></div>
            <div>
                <div class="sl2">Total Livres</div>
                <div class="sv">{{ $totalLivres }}</div>
                <div class="ss">{{ $livresDisponibles }} disponibles</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="sc">
            <div class="sic" style="background:#d1fae5;color:#065f46;"><i class="bi bi-people"></i></div>
            <div>
                <div class="sl2">Adhérents</div>
                <div class="sv">{{ $totalAdherents }}</div>
                <div class="ss">membres actifs</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="sc">
            <div class="sic" style="background:#fef3c7;color:#92400e;"><i class="bi bi-arrow-left-right"></i></div>
            <div>
                <div class="sl2">Emprunts actifs</div>
                <div class="sv">{{ $empruntsActifs }}</div>
                <div class="ss">en cours</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="sc">
            <div class="sic" style="background:#fee2e2;color:#991b1b;"><i class="bi bi-exclamation-triangle"></i></div>
            <div>
                <div class="sl2">Retards</div>
                <div class="sv">{{ $empruntsEnRetard }}</div>
                <div class="ss">à relancer</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    {{-- Derniers emprunts --}}
    <div class="col-lg-7">
        <div class="tc">
            <div class="th">
                <div class="fw-semibold" style="font-size:.9rem">Derniers emprunts</div>
                <a href="{{ route('emprunts.index') }}" class="btn btn-sm btn-outline-secondary" style="font-size:.78rem;border-radius:7px;">Tout voir</a>
            </div>
            <div class="table-responsive">
                <table class="table table-borderless mb-0">
                    <thead><tr>
                        <th>Livre</th><th>Adhérent</th><th>Date</th><th>Statut</th>
                    </tr></thead>
                    <tbody>
                    @forelse($derniersEmprunts as $e)
                        <tr>
                            <td>{{ Str::limit($e->livre->titre,28) }}</td>
                            <td>{{ $e->adherent->prenom }} {{ $e->adherent->nom }}</td>
                            <td>{{ $e->date_emprunt->format('d/m/Y') }}</td>
                            <td>
                                @if($e->statut=='retourne')
                                    <span class="bp bs">Retourné</span>
                                @elseif($e->isEnRetard())
                                    <span class="bp bd">En retard</span>
                                @else
                                    <span class="bp bw">En cours</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center text-muted py-4" style="font-size:.85rem">Aucun emprunt</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Top catégories + Actions rapides --}}
    <div class="col-lg-5 d-flex flex-column gap-3">
        <div class="tc">
            <div class="th"><div class="fw-semibold" style="font-size:.9rem">Catégories populaires</div></div>
            <div class="p-3 d-flex flex-column gap-2">
                @forelse($topCategories as $cat)
                <div class="d-flex align-items-center justify-content-between">
                    <span style="font-size:.85rem;color:#334155;">{{ $cat->nom }}</span>
                    <span class="bp bm">{{ $cat->livres_count }} livres</span>
                </div>
                @empty
                    <p class="text-muted text-center mb-0" style="font-size:.85rem">Aucune catégorie</p>
                @endforelse
            </div>
        </div>
        <div class="tc">
            <div class="th"><div class="fw-semibold" style="font-size:.9rem">Actions rapides</div></div>
            <div class="p-3 d-flex flex-column gap-2">
                <a href="{{ route('livres.create') }}" class="btn btn-primary btn-sm d-flex align-items-center gap-2">
                    <i class="bi bi-plus-circle"></i> Ajouter un livre
                </a>
                <a href="{{ route('adherents.create') }}" class="btn btn-outline-primary btn-sm d-flex align-items-center gap-2">
                    <i class="bi bi-person-plus"></i> Nouvel adhérent
                </a>
                <a href="{{ route('emprunts.create') }}" class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-2">
                    <i class="bi bi-arrow-right-circle"></i> Enregistrer un emprunt
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

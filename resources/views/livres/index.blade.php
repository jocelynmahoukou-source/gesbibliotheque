@extends('layouts.app')
@section('title','Livres')
@section('breadcrumb','Livres')
@section('page-title','Gestion des Livres')
@section('content')
<div class="tc">
    <div class="th">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-journals text-primary"></i>
            <span class="fw-semibold" style="font-size:.9rem">{{ $livres->total() }} livres</span>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <form method="GET" class="d-flex gap-2">
                <div class="sw2">
                    <i class="bi bi-search"></i>
                    <input name="q" value="{{ request('q') }}" class="form-control form-control-sm si" placeholder="Titre, ISBN, auteur..." style="width:220px">
                </div>
                <select name="categorie_id" class="form-select form-select-sm" style="border-radius:8px;font-size:.82rem;border-color:#d1d5db;">
                    <option value="">Toutes catégories</option>
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}" {{ request('categorie_id')==$c->id?'selected':'' }}>{{ $c->nom }}</option>
                    @endforeach
                </select>
                <button class="btn btn-sm btn-outline-secondary" style="border-radius:8px;font-size:.82rem;">Filtrer</button>
                @if(request('q')||request('categorie_id'))
                    <a href="{{ route('livres.index') }}" class="btn btn-sm btn-ghost" style="border-radius:8px;font-size:.82rem;">✕</a>
                @endif
            </form>
            <a href="{{ route('livres.create') }}" class="btn btn-primary btn-sm d-flex align-items-center gap-1" style="border-radius:8px;font-size:.82rem;">
                <i class="bi bi-plus-lg"></i> Nouveau livre
            </a>
        </div>
    </div>
    @if($livres->count())
    <div class="table-responsive">
        <table class="table table-borderless mb-0">
            <thead><tr>
                <th>Titre</th><th>Auteur</th><th>Catégorie</th><th>ISBN</th><th>Année</th><th>Stock</th><th>Dispo</th><th>Actions</th>
            </tr></thead>
            <tbody>
            @foreach($livres as $l)
            <tr>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        <div class="av" style="background:#eef2ff;color:#6366f1;font-size:.7rem;">
                            {{ strtoupper(substr($l->titre,0,2)) }}
                        </div>
                        <div>
                            <div class="fw-semibold" style="font-size:.85rem;">{{ Str::limit($l->titre,35) }}</div>
                        </div>
                    </div>
                </td>
                <td>{{ $l->auteur->prenom }} {{ $l->auteur->nom }}</td>
                <td><span class="bp bm">{{ $l->categorie->nom }}</span></td>
                <td style="font-size:.78rem;color:#64748b;">{{ $l->isbn ?? '—' }}</td>
                <td>{{ $l->annee_publication ?? '—' }}</td>
                <td>{{ $l->quantite }}</td>
                <td>
                    @if($l->quantite_disponible > 0)
                        <span class="bp bs">{{ $l->quantite_disponible }}</span>
                    @else
                        <span class="bp bd">Épuisé</span>
                    @endif
                </td>
                <td>
                    <div class="d-flex gap-1">
                        <a href="{{ route('livres.show',$l) }}" class="btn btn-sm btn-outline-secondary ba" title="Voir"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('livres.edit',$l) }}" class="btn btn-sm btn-outline-primary ba" title="Modifier"><i class="bi bi-pencil"></i></a>
                        <form method="POST" action="{{ route('livres.destroy',$l) }}" onsubmit="return confirm('Supprimer ce livre ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger ba" title="Supprimer"><i class="bi bi-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="px-4 py-3 border-top">{{ $livres->withQueryString()->links() }}</div>
    @else
        <div class="es">
            <i class="bi bi-journals"></i>
            <h6>Aucun livre trouvé</h6>
            <p>Ajoutez votre premier livre pour commencer.</p>
            <a href="{{ route('livres.create') }}" class="btn btn-primary btn-sm">Ajouter un livre</a>
        </div>
    @endif
</div>
@endsection

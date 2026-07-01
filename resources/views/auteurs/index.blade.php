@extends('layouts.app')
@section('title','Auteurs')
@section('breadcrumb','Auteurs')
@section('page-title','Gestion des Auteurs')
@section('content')
<div class="tc">
    <div class="th">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-person-lines-fill text-primary"></i>
            <span class="fw-semibold" style="font-size:.9rem">{{ $auteurs->total() }} auteurs</span>
        </div>
        <div class="d-flex gap-2">
            <form method="GET" class="d-flex gap-2">
                <div class="sw2"><i class="bi bi-search"></i>
                    <input name="q" value="{{ request('q') }}" class="form-control form-control-sm si" placeholder="Rechercher..." style="width:200px">
                </div>
                <button class="btn btn-sm btn-outline-secondary" style="border-radius:8px;font-size:.82rem;">Filtrer</button>
            </form>
            <a href="{{ route('auteurs.create') }}" class="btn btn-primary btn-sm d-flex align-items-center gap-1" style="border-radius:8px;font-size:.82rem;">
                <i class="bi bi-plus-lg"></i> Nouvel auteur
            </a>
        </div>
    </div>
    @if($auteurs->count())
    <div class="table-responsive">
        <table class="table table-borderless mb-0">
            <thead><tr><th>Auteur</th><th>Nationalité</th><th>Livres</th><th>Actions</th></tr></thead>
            <tbody>
            @foreach($auteurs as $a)
            <tr>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        <div class="av" style="background:#d1fae5;color:#065f46;">{{ strtoupper(substr($a->prenom,0,1).substr($a->nom,0,1)) }}</div>
                        <div>
                            <div class="fw-semibold" style="font-size:.85rem;">{{ $a->prenom }} {{ $a->nom }}</div>
                            @if($a->bio)<div style="font-size:.75rem;color:#64748b;">{{ Str::limit($a->bio,50) }}</div>@endif
                        </div>
                    </div>
                </td>
                <td>{{ $a->nationalite ?? '—' }}</td>
                <td><span class="bp bm">{{ $a->livres_count }} livres</span></td>
                <td>
                    <div class="d-flex gap-1">
                        <a href="{{ route('auteurs.edit',$a) }}" class="btn btn-sm btn-outline-primary ba"><i class="bi bi-pencil"></i></a>
                        <form method="POST" action="{{ route('auteurs.destroy',$a) }}" onsubmit="return confirm('Supprimer cet auteur ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger ba"><i class="bi bi-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="px-4 py-3 border-top">{{ $auteurs->withQueryString()->links() }}</div>
    @else
        <div class="es"><i class="bi bi-person-lines-fill"></i><h6>Aucun auteur</h6><a href="{{ route('auteurs.create') }}" class="btn btn-primary btn-sm mt-1">Ajouter</a></div>
    @endif
</div>
@endsection

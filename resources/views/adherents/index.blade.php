@extends('layouts.app')
@section('title','Adhérents')
@section('breadcrumb','Adhérents')
@section('page-title','Gestion des Adhérents')
@section('content')
<div class="tc">
    <div class="th">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-people text-primary"></i>
            <span class="fw-semibold" style="font-size:.9rem">{{ $adherents->total() }} adhérents</span>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <form method="GET" class="d-flex gap-2">
                <div class="sw2"><i class="bi bi-search"></i>
                    <input name="q" value="{{ request('q') }}" class="form-control form-control-sm si" placeholder="Nom, email..." style="width:200px">
                </div>
                <select name="statut" class="form-select form-select-sm" style="border-radius:8px;font-size:.82rem;border-color:#d1d5db;">
                    <option value="">Tous statuts</option>
                    <option value="actif" {{ request('statut')=='actif'?'selected':'' }}>Actif</option>
                    <option value="suspendu" {{ request('statut')=='suspendu'?'selected':'' }}>Suspendu</option>
                </select>
                <button class="btn btn-sm btn-outline-secondary" style="border-radius:8px;font-size:.82rem;">Filtrer</button>
            </form>
            <a href="{{ route('adherents.create') }}" class="btn btn-primary btn-sm d-flex align-items-center gap-1" style="border-radius:8px;font-size:.82rem;">
                <i class="bi bi-plus-lg"></i> Nouvel adhérent
            </a>
        </div>
    </div>
    @if($adherents->count())
    <div class="table-responsive">
        <table class="table table-borderless mb-0">
            <thead><tr><th>Adhérent</th><th>Email</th><th>Téléphone</th><th>Depuis</th><th>Emprunts</th><th>Statut</th><th>Actions</th></tr></thead>
            <tbody>
            @foreach($adherents as $a)
            <tr>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        <div class="av" style="background:#e0f2fe;color:#075985;">{{ strtoupper(substr($a->prenom,0,1).substr($a->nom,0,1)) }}</div>
                        <div>
                            <div class="fw-semibold" style="font-size:.85rem">{{ $a->prenom }} {{ $a->nom }}</div>
                        </div>
                    </div>
                </td>
                <td style="font-size:.82rem">{{ $a->email ?? '—' }}</td>
                <td style="font-size:.82rem">{{ $a->telephone ?? '—' }}</td>
                <td style="font-size:.82rem;color:#64748b">{{ $a->date_adhesion->format('d/m/Y') }}</td>
                <td><span class="bp bm">{{ $a->emprunts_count }}</span></td>
                <td>
                    @if($a->statut=='actif') <span class="bp bs">Actif</span>
                    @else <span class="bp bd">Suspendu</span> @endif
                </td>
                <td>
                    <div class="d-flex gap-1">
                        <a href="{{ route('adherents.show',$a) }}" class="btn btn-sm btn-outline-secondary ba"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('adherents.edit',$a) }}" class="btn btn-sm btn-outline-primary ba"><i class="bi bi-pencil"></i></a>
                        <form method="POST" action="{{ route('adherents.destroy',$a) }}" onsubmit="return confirm('Supprimer ?')">
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
    <div class="px-4 py-3 border-top">{{ $adherents->withQueryString()->links() }}</div>
    @else
        <div class="es"><i class="bi bi-people"></i><h6>Aucun adhérent</h6>
            <a href="{{ route('adherents.create') }}" class="btn btn-primary btn-sm">Ajouter</a></div>
    @endif
</div>
@endsection

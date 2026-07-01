@extends('layouts.app')
@section('title','Emprunts')
@section('breadcrumb','Emprunts')
@section('page-title','Gestion des Emprunts')
@section('content')
<div class="tc">
    <div class="th">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-arrow-left-right text-primary"></i>
            <span class="fw-semibold" style="font-size:.9rem">{{ $emprunts->total() }} emprunts</span>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <form method="GET" class="d-flex gap-2 flex-wrap">
                <div class="sw2"><i class="bi bi-search"></i>
                    <input name="q" value="{{ request('q') }}" class="form-control form-control-sm si" placeholder="Livre ou adhérent..." style="width:200px">
                </div>
                <select name="statut" class="form-select form-select-sm" style="border-radius:8px;font-size:.82rem;border-color:#d1d5db;">
                    <option value="">Tous statuts</option>
                    <option value="en_cours" {{ request('statut')=='en_cours'?'selected':'' }}>En cours</option>
                    <option value="retourne" {{ request('statut')=='retourne'?'selected':'' }}>Retourné</option>
                    <option value="en_retard" {{ request('statut')=='en_retard'?'selected':'' }}>En retard</option>
                </select>
                <button class="btn btn-sm btn-outline-secondary" style="border-radius:8px;font-size:.82rem;">Filtrer</button>
            </form>
            <a href="{{ route('emprunts.create') }}" class="btn btn-primary btn-sm d-flex align-items-center gap-1" style="border-radius:8px;font-size:.82rem;">
                <i class="bi bi-plus-lg"></i> Nouvel emprunt
            </a>
        </div>
    </div>
    @if($emprunts->count())
    <div class="table-responsive">
        <table class="table table-borderless mb-0">
            <thead><tr><th>Livre</th><th>Adhérent</th><th>Emprunté</th><th>Retour prévu</th><th>Rendu le</th><th>Statut</th><th>Actions</th></tr></thead>
            <tbody>
            @foreach($emprunts as $e)
            <tr>
                <td style="font-size:.83rem;max-width:180px;">{{ Str::limit($e->livre->titre,30) }}</td>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        <div class="av" style="background:#e0f2fe;color:#075985;font-size:.7rem;">{{ strtoupper(substr($e->adherent->prenom,0,1).substr($e->adherent->nom,0,1)) }}</div>
                        <span style="font-size:.83rem">{{ $e->adherent->prenom }} {{ $e->adherent->nom }}</span>
                    </div>
                </td>
                <td style="font-size:.82rem">{{ $e->date_emprunt->format('d/m/Y') }}</td>
                <td style="font-size:.82rem">{{ $e->date_retour_prevue->format('d/m/Y') }}</td>
                <td style="font-size:.82rem">{{ $e->date_retour_effective?$e->date_retour_effective->format('d/m/Y'):'—' }}</td>
                <td>
                    @if($e->statut=='retourne')<span class="bp bs">Retourné</span>
                    @elseif($e->isEnRetard())<span class="bp bd">En retard</span>
                    @else<span class="bp bw">En cours</span>@endif
                </td>
                <td>
                    <div class="d-flex gap-1">
                        @if($e->statut !== 'retourne')
                            <form method="POST" action="{{ route('emprunts.retour',$e) }}" onsubmit="return confirm('Confirmer le retour ?')">
                                @csrf @method('PATCH')
                                <button class="btn btn-sm btn-outline-success ba" title="Retour"><i class="bi bi-check-circle"></i></button>
                            </form>
                        @endif
                        <a href="{{ route('emprunts.edit',$e) }}" class="btn btn-sm btn-outline-primary ba"><i class="bi bi-pencil"></i></a>
                        <form method="POST" action="{{ route('emprunts.destroy',$e) }}" onsubmit="return confirm('Supprimer ?')">
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
    <div class="px-4 py-3 border-top">{{ $emprunts->withQueryString()->links() }}</div>
    @else
        <div class="es"><i class="bi bi-arrow-left-right"></i><h6>Aucun emprunt</h6>
            <a href="{{ route('emprunts.create') }}" class="btn btn-primary btn-sm">Créer un emprunt</a></div>
    @endif
</div>
@endsection

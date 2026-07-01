@extends('layouts.app')
@section('title','Nouvel emprunt')
@section('breadcrumb','Emprunts / Nouveau')
@section('page-title','Enregistrer un emprunt')
@section('content')
<div class="row justify-content-center"><div class="col-lg-7">
<div class="fc">
    <div class="fch d-flex align-items-center gap-2">
        <div class="av" style="background:#eef2ff;color:#6366f1;"><i class="bi bi-arrow-right-circle-fill"></i></div>
        <div><div class="fw-semibold">Nouvel emprunt</div>
        <div style="font-size:.75rem;color:#64748b;">Durée par défaut : 14 jours</div></div>
    </div>
    <div class="fcb">
        @if($errors->any())<div class="alert alert-danger mb-3">@foreach($errors->all() as $e){{ $e }}<br>@endforeach</div>@endif
        <form method="POST" action="{{ route('emprunts.store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Livre <span class="text-danger">*</span></label>
                    <select name="livre_id" class="form-select" required>
                        <option value="">Sélectionner un livre</option>
                        @foreach($livres as $l)
                            <option value="{{ $l->id }}" {{ old('livre_id', request('livre_id'))==$l->id?'selected':'' }}>
                                {{ $l->titre }} ({{ $l->quantite_disponible }} dispo)
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">Adhérent <span class="text-danger">*</span></label>
                    <select name="adherent_id" class="form-select" required>
                        <option value="">Sélectionner un adhérent</option>
                        @foreach($adherents as $a)
                            <option value="{{ $a->id }}" {{ old('adherent_id', request('adherent_id'))==$a->id?'selected':'' }}>
                                {{ $a->prenom }} {{ $a->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Date d'emprunt <span class="text-danger">*</span></label>
                    <input type="date" name="date_emprunt" value="{{ old('date_emprunt', date('Y-m-d')) }}" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Date de retour prévue <span class="text-danger">*</span></label>
                    <input type="date" name="date_retour_prevue" value="{{ old('date_retour_prevue', date('Y-m-d', strtotime('+14 days'))) }}" class="form-control" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="form-control" rows="2" placeholder="Remarques éventuelles...">{{ old('notes') }}</textarea>
                </div>
            </div>
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Enregistrer</button>
                <a href="{{ route('emprunts.index') }}" class="btn btn-outline-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
</div></div>
@endsection

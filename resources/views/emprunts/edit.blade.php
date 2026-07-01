@extends('layouts.app')
@section('title','Modifier emprunt')
@section('breadcrumb','Emprunts / Modifier')
@section('page-title','Modifier un emprunt')
@section('content')
<div class="row justify-content-center"><div class="col-lg-7">
<div class="fc">
    <div class="fch"><div class="fw-semibold">Modifier l'emprunt</div></div>
    <div class="fcb">
        @if($errors->any())<div class="alert alert-danger mb-3">@foreach($errors->all() as $e){{ $e }}<br>@endforeach</div>@endif
        <form method="POST" action="{{ route('emprunts.update',$emprunt) }}">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Livre</label>
                    <input type="text" class="form-control" value="{{ $emprunt->livre->titre }}" readonly style="background:#f8fafc;">
                </div>
                <div class="col-12">
                    <label class="form-label">Adhérent</label>
                    <input type="text" class="form-control" value="{{ $emprunt->adherent->prenom }} {{ $emprunt->adherent->nom }}" readonly style="background:#f8fafc;">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Date d'emprunt</label>
                    <input type="date" name="date_emprunt" value="{{ old('date_emprunt',$emprunt->date_emprunt->format('Y-m-d')) }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Date de retour prévue</label>
                    <input type="date" name="date_retour_prevue" value="{{ old('date_retour_prevue',$emprunt->date_retour_prevue->format('Y-m-d')) }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Statut</label>
                    <select name="statut" class="form-select">
                        <option value="en_cours" {{ old('statut',$emprunt->statut)=='en_cours'?'selected':'' }}>En cours</option>
                        <option value="retourne" {{ old('statut',$emprunt->statut)=='retourne'?'selected':'' }}>Retourné</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Date de retour effective</label>
                    <input type="date" name="date_retour_effective" value="{{ old('date_retour_effective',$emprunt->date_retour_effective?$emprunt->date_retour_effective->format('Y-m-d'):'') }}" class="form-control">
                </div>
                <div class="col-12">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="form-control" rows="2">{{ old('notes',$emprunt->notes) }}</textarea>
                </div>
            </div>
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Mettre à jour</button>
                <a href="{{ route('emprunts.index') }}" class="btn btn-outline-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
</div></div>
@endsection

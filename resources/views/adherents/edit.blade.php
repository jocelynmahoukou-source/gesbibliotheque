@extends('layouts.app')
@section('title','Modifier adhérent')
@section('breadcrumb','Adhérents / Modifier')
@section('page-title','Modifier adhérent')
@section('content')
<div class="row justify-content-center"><div class="col-lg-7">
<div class="fc">
    <div class="fch"><div class="fw-semibold">Modifier — {{ $adherent->prenom }} {{ $adherent->nom }}</div></div>
    <div class="fcb">
        @if($errors->any())<div class="alert alert-danger mb-3">@foreach($errors->all() as $e){{ $e }}<br>@endforeach</div>@endif
        <form method="POST" action="{{ route('adherents.update',$adherent) }}">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-6"><label class="form-label">Prénom <span class="text-danger">*</span></label>
                    <input type="text" name="prenom" value="{{ old('prenom',$adherent->prenom) }}" class="form-control" required></div>
                <div class="col-md-6"><label class="form-label">Nom <span class="text-danger">*</span></label>
                    <input type="text" name="nom" value="{{ old('nom',$adherent->nom) }}" class="form-control" required></div>
                <div class="col-md-6"><label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email',$adherent->email) }}" class="form-control"></div>
                <div class="col-md-6"><label class="form-label">Téléphone</label>
                    <input type="text" name="telephone" value="{{ old('telephone',$adherent->telephone) }}" class="form-control"></div>
                <div class="col-12"><label class="form-label">Adresse</label>
                    <textarea name="adresse" class="form-control" rows="2">{{ old('adresse',$adherent->adresse) }}</textarea></div>
                <div class="col-md-6"><label class="form-label">Date d'adhésion</label>
                    <input type="date" name="date_adhesion" value="{{ old('date_adhesion',$adherent->date_adhesion->format('Y-m-d')) }}" class="form-control"></div>
                <div class="col-md-6"><label class="form-label">Statut</label>
                    <select name="statut" class="form-select">
                        <option value="actif" {{ old('statut',$adherent->statut)=='actif'?'selected':'' }}>Actif</option>
                        <option value="suspendu" {{ old('statut',$adherent->statut)=='suspendu'?'selected':'' }}>Suspendu</option>
                    </select>
                </div>
            </div>
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Mettre à jour</button>
                <a href="{{ route('adherents.index') }}" class="btn btn-outline-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
</div></div>
@endsection

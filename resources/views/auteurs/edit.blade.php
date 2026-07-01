@extends('layouts.app')
@section('title','Modifier auteur')
@section('breadcrumb','Auteurs / Modifier')
@section('page-title','Modifier auteur')
@section('content')
<div class="row justify-content-center"><div class="col-lg-7">
<div class="fc">
    <div class="fch"><div class="fw-semibold">Modifier — {{ $auteur->prenom }} {{ $auteur->nom }}</div></div>
    <div class="fcb">
        @if($errors->any())<div class="alert alert-danger mb-3">@foreach($errors->all() as $e){{ $e }}<br>@endforeach</div>@endif
        <form method="POST" action="{{ route('auteurs.update',$auteur) }}">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-6"><label class="form-label">Prénom <span class="text-danger">*</span></label>
                    <input type="text" name="prenom" value="{{ old('prenom',$auteur->prenom) }}" class="form-control" required></div>
                <div class="col-md-6"><label class="form-label">Nom <span class="text-danger">*</span></label>
                    <input type="text" name="nom" value="{{ old('nom',$auteur->nom) }}" class="form-control" required></div>
                <div class="col-12"><label class="form-label">Nationalité</label>
                    <input type="text" name="nationalite" value="{{ old('nationalite',$auteur->nationalite) }}" class="form-control"></div>
                <div class="col-12"><label class="form-label">Biographie</label>
                    <textarea name="bio" class="form-control" rows="4">{{ old('bio',$auteur->bio) }}</textarea></div>
            </div>
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Mettre à jour</button>
                <a href="{{ route('auteurs.index') }}" class="btn btn-outline-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
</div></div>
@endsection

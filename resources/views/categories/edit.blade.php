@extends('layouts.app')
@section('title','Modifier catégorie')
@section('breadcrumb','Catégories / Modifier')
@section('page-title','Modifier catégorie')
@section('content')
<div class="row justify-content-center"><div class="col-lg-6">
<div class="fc">
    <div class="fch"><div class="fw-semibold">Modifier — {{ $categorie->nom }}</div></div>
    <div class="fcb">
        @if($errors->any())<div class="alert alert-danger mb-3">@foreach($errors->all() as $e){{ $e }}<br>@endforeach</div>@endif
        <form method="POST" action="{{ route('categories.update', ['categorie' => $categorie->id]) }}">
            @csrf @method('PUT')
            <div class="mb-3"><label class="form-label">Nom <span class="text-danger">*</span></label>
                <input type="text" name="nom" value="{{ old('nom',$categorie->nom) }}" class="form-control" required></div>
            <div class="mb-3"><label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description',$categorie->description) }}</textarea></div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Mettre à jour</button>
                <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
</div></div>
@endsection

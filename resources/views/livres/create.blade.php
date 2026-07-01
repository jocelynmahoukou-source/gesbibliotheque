@extends('layouts.app')
@section('title','Nouveau livre')
@section('breadcrumb','Livres / Nouveau')
@section('page-title','Ajouter un livre')
@section('content')
<div class="row justify-content-center">
<div class="col-lg-8">
<div class="fc">
    <div class="fch d-flex align-items-center gap-2">
        <div class="av" style="background:#eef2ff;color:#6366f1;"><i class="bi bi-book-fill"></i></div>
        <div>
            <div class="fw-semibold">Nouveau livre</div>
            <div style="font-size:.75rem;color:#64748b;">Remplissez les informations du livre</div>
        </div>
    </div>
    <div class="fcb">
        @if($errors->any())
            <div class="alert alert-danger mb-3"><i class="bi bi-x-circle-fill me-2"></i>
                @foreach($errors->all() as $e) {{ $e }}<br> @endforeach
            </div>
        @endif
        <form method="POST" action="{{ route('livres.store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Titre <span class="text-danger">*</span></label>
                    <input type="text" name="titre" value="{{ old('titre') }}" class="form-control" placeholder="Titre du livre" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Auteur <span class="text-danger">*</span></label>
                    <select name="auteur_id" class="form-select" required>
                        <option value="">Sélectionner un auteur</option>
                        @foreach($auteurs as $a)
                            <option value="{{ $a->id }}" {{ old('auteur_id')==$a->id?'selected':'' }}>{{ $a->prenom }} {{ $a->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Catégorie <span class="text-danger">*</span></label>
                    <select name="categorie_id" class="form-select" required>
                        <option value="">Sélectionner une catégorie</option>
                        @foreach($categories as $c)
                            <option value="{{ $c->id }}" {{ old('categorie_id')==$c->id?'selected':'' }}>{{ $c->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">ISBN</label>
                    <input type="text" name="isbn" value="{{ old('isbn') }}" class="form-control" placeholder="Ex: 978-2-07-036024-5">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Année de publication</label>
                    <input type="number" name="annee_publication" value="{{ old('annee_publication') }}" class="form-control" min="1000" max="{{ date('Y') }}" placeholder="{{ date('Y') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Quantité <span class="text-danger">*</span></label>
                    <input type="number" name="quantite" value="{{ old('quantite',1) }}" class="form-control" min="1" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Résumé ou description du livre...">{{ old('description') }}</textarea>
                </div>
            </div>
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Enregistrer</button>
                <a href="{{ route('livres.index') }}" class="btn btn-outline-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
</div>
</div>
@endsection

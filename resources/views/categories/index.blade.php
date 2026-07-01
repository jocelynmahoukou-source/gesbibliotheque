@extends('layouts.app')
@section('title','Catégories')
@section('breadcrumb','Catégories')
@section('page-title','Gestion des Catégories')
@section('content')
<div class="row g-3">
    <div class="col-md-4">
        <div class="fc">
            <div class="fch"><div class="fw-semibold">Nouvelle catégorie</div></div>
            <div class="fcb">
                @if($errors->any())<div class="alert alert-danger mb-3" style="font-size:.82rem">@foreach($errors->all() as $e){{ $e }}<br>@endforeach</div>@endif
                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf
                    <div class="mb-3"><label class="form-label">Nom <span class="text-danger">*</span></label>
                        <input type="text" name="nom" value="{{ old('nom') }}" class="form-control" placeholder="Ex: Roman, Science..." required></div>
                    <div class="mb-3"><label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Description...">{{ old('description') }}</textarea></div>
                    <button type="submit" class="btn btn-primary btn-sm w-100"><i class="bi bi-plus-lg me-1"></i>Ajouter</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="tc">
            <div class="th"><span class="fw-semibold" style="font-size:.9rem">{{ $categories->count() }} catégories</span></div>
            @if($categories->count())
            <div class="table-responsive">
                <table class="table table-borderless mb-0">
                    <thead><tr><th>Nom</th><th>Description</th><th>Livres</th><th>Actions</th></tr></thead>
                    <tbody>
                    @foreach($categories as $c)
                    <tr>
                        <td><div class="d-flex align-items-center gap-2">
                            <div style="width:8px;height:8px;background:#6366f1;border-radius:50%;flex-shrink:0;"></div>
                            <span class="fw-semibold" style="font-size:.85rem">{{ $c->nom }}</span>
                        </div></td>
                        <td style="font-size:.82rem;color:#64748b;">{{ Str::limit($c->description,40) ?? '—' }}</td>
                        <td><span class="bp bm">{{ $c->livres_count }}</span></td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('categories.edit',$c) }}" class="btn btn-sm btn-outline-primary ba"><i class="bi bi-pencil"></i></a>
                                <form method="POST" action="{{ route('categories.destroy',$c) }}" onsubmit="return confirm('Supprimer ?')">
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
            @else
                <div class="es"><i class="bi bi-tags"></i><h6>Aucune catégorie</h6></div>
            @endif
        </div>
    </div>
</div>
@endsection

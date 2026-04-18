@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-dark text-white fw-bold">
                    <i class="bi bi-plus-circle me-1"></i> Nouvelle Catégorie
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.category.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nom de la catégorie</label>
                            <input type="text" name="name" class="form-control border-2" placeholder="Ex: Électricité" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 fw-bold">
                            <i class="bi bi-check-lg"></i> Créer la catégorie
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-list-ul me-1"></i> Catégories existantes</span>
                    <span class="badge bg-secondary">{{ $categories->count() }} au total</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3">Nom</th>
                                    <th class="text-center">Articles liés</th>
                                    <th class="text-end pe-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td class="ps-3 fw-bold">{{ $category->name }}</td>
                                    <td class="text-center">
                                        <span class="badge rounded-pill bg-info text-dark">
                                            {{ $category->products->count() }} produit(s)
                                        </span>
                                    </td>
                                    <td class="text-end pe-3">
                                        <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Attention : Supprimer cette catégorie pourrait affecter les produits liés. Confirmer ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

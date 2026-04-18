@extends('layouts.admin')

@section('content')
<style>
    .admin-thumb {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    .filter-section {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        border: 1px solid #dee2e6;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Gestion des Articles</h2>
    <a href="{{ route('admin.product.create') }}" class="btn btn-primary shadow-sm">+ Ajouter un article</a>
</div>

<div class="filter-section mb-4 shadow-sm">
    <form action="{{ route('admin.index') }}" method="GET" class="row g-3">
        <div class="col-md-5">
            <label class="form-label small fw-bold">Rechercher par nom</label>
            <input type="text" name="search" class="form-control" placeholder="Ex: Pince, Ampoule..." value="{{ request('search') }}">
        </div>

        <div class="col-md-4">
            <label class="form-label small fw-bold">Filtrer par catégorie</label>
            <select name="category" class="form-select">
                <option value="">Toutes les catégories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3 d-flex align-items-end gap-2 pb-1">
            <button type="submit" class="btn btn-dark w-100">Filtrer</button>
            <a href="{{ route('admin.index') }}" class="btn btn-outline-secondary w-100">Réinitialiser</a>
        </div>
    </form>
</div>

<div class="table-responsive shadow-sm">
    <table class="table table-bordered table-hover align-middle bg-white">
        <thead class="table-dark">
            <tr>
                <th style="width: 80px;">Image</th>
                <th>Nom</th>
                <th>Catégorie</th>
                <th>Prix</th>
                <th style="width: 180px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr>
                <td>
                    @if($product->image)
                        <img src="{{ asset('storage/products/'.$product->image) }}" alt="{{ $product->name }}" class="admin-thumb">
                    @else
                        <div class="admin-thumb d-flex align-items-center justify-content-center bg-light text-muted small">N/A</div>
                    @endif
                </td>
                <td class="fw-bold text-dark">{{ $product->name }}</td>
                <td><span class="badge bg-info text-dark">{{ $product->category->name }}</span></td>
                <td>
                    @foreach($product->prices as $price)
                        <span class="badge bg-secondary">{{ number_format($price->price, 0, ',', ' ') }} F</span>
                    @endforeach
                </td>
                <td style="white-space: nowrap;">
                    <div class="d-flex gap-2 justify-content-start">
                        <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-sm btn-warning d-flex align-items-center">
                            <i class="bi bi-pencil me-1"></i> Modifier
                        </a>

                        <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST" class="m-0" onsubmit="return confirm('Supprimer cet article ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger d-flex align-items-center">
                                <i class="bi bi-trash me-1"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-4 text-muted">Aucun article trouvé pour cette recherche.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@extends('layouts.admin')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card border-0 shadow-lg">
            <div class="card-header bg-warning py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-pencil-square fs-4 me-2"></i>
                        <h5 class="mb-0 fw-bold">Modifier l'article : {{ $product->name }}</h5>
                    </div>
                    <a href="{{ route('admin.index') }}" class="btn btn-sm btn-outline-dark fw-bold">
                        <i class="bi bi-x-lg"></i> Annuler
                    </a>
                </div>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-7">
                            <div class="mb-4">
                                <label class="form-label fw-bold"><i class="bi bi-tag me-1"></i> Nom de l'article</label>
                                <input type="text" name="name" class="form-control form-control-lg border-2" value="{{ $product->name }}" required>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold"><i class="bi bi-grid me-1"></i> Catégorie</label>
                                    <select name="category_id" class="form-select border-2" required>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold"><i class="bi bi-cash-stack me-1"></i> Prix</label>
                                    <input type="text" name="prices" class="form-control border-2" value="{{ $pricesString }}" required>
                                    <div class="form-text mt-1 small">Séparez par une virgule (ex: 500, 1000).</div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold"><i class="bi bi-card-text me-1"></i> Description technique</label>
                                <textarea name="description" class="form-control border-2" rows="5">{{ $product->description }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-5 border-start ps-md-4">
                            <div class="mb-4">
                                <label class="form-label fw-bold"><i class="bi bi-image me-1"></i> Image du produit</label>

                                <div id="preview-container" class="mb-3">
                                    <div class="position-relative d-inline-block w-100 text-center">
                                        @if($product->image)
                                            <img id="image-preview" src="{{ asset('storage/products/'.$product->image) }}" alt="Aperçu" class="img-fluid rounded shadow-sm border" style="max-height: 200px; width: 100%; object-fit: contain; background: #fff;">
                                        @else
                                            <img id="image-preview" src="#" alt="Aperçu" class="img-fluid rounded shadow-sm border d-none" style="max-height: 200px; width: 100%; object-fit: contain; background: #fff;">
                                        @endif
                                    </div>
                                </div>

                                <div class="image-upload-wrapper border-2 border-dashed rounded text-center p-4 bg-light">
                                    <i class="bi bi-cloud-arrow-up fs-1 text-primary" id="upload-icon"></i>
                                    <input type="file" name="image" class="form-control mt-3" id="imgInp" accept="image/*">
                                    <p class="text-muted small mt-2">Laissez vide pour conserver l'image actuelle</p>
                                </div>
                            </div>

                            <div class="alert alert-warning border-0 shadow-sm small">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                La modification du prix sera immédiatement visible sur le catalogue WhatsApp.
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-5 py-2 fw-bold shadow-sm">
                            <i class="bi bi-save me-1"></i> Enregistrer les modifications
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .border-dashed { border-style: dashed !important; border-color: #dee2e6 !important; }
    .image-upload-wrapper { transition: all 0.2s ease-in-out; cursor: pointer; }
    .image-upload-wrapper:hover { background-color: #e9ecef !important; border-color: #ffc107 !important; }

    .form-control:focus, .form-select:focus {
        border-color: #ffc107;
        box-shadow: none;
    }
    .card { border-radius: 15px; overflow: hidden; }
</style>

<script>
    const imgInp = document.getElementById('imgInp');
    const imagePreview = document.getElementById('image-preview');
    const uploadIcon = document.getElementById('upload-icon');

    imgInp.onchange = evt => {
        const [file] = imgInp.files;
        if (file) {
            imagePreview.src = URL.createObjectURL(file);
            imagePreview.classList.remove('d-none');

            // Changement d'icône pour confirmer
            uploadIcon.classList.replace('bi-cloud-arrow-up', 'bi-check-circle-fill');
            uploadIcon.classList.replace('text-primary', 'text-success');
        }
    }
</script>
@endsection

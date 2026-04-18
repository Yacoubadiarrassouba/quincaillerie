@extends('layouts.admin')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card border-0 shadow-lg">
            <div class="card-header bg-dark text-white py-3">
                <div class="d-flex align-items-center">
                    <i class="bi bi-plus-circle-dotted fs-4 me-2"></i>
                    <h5 class="mb-0 fw-bold">Ajouter un nouvel article</h5>
                </div>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-7">
                            <div class="mb-4">
                                <label class="form-label fw-bold"><i class="bi bi-tag me-1"></i> Nom de l'article</label>
                                <input type="text" name="name" class="form-control form-control-lg border-2" placeholder="Ex: Marteau de menuisier" required>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold"><i class="bi bi-grid me-1"></i> Catégorie</label>
                                    <select name="category_id" class="form-select border-2" required>
                                        <option value="">Choisir...</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold"><i class="bi bi-cash-stack me-1"></i> Prix</label>
                                    <input type="text" name="prices" class="form-control border-2" placeholder="Ex: 500, 1500" required>
                                    <div class="form-text mt-1 small">Séparez par une virgule pour plusieurs formats.</div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold"><i class="bi bi-card-text me-1"></i> Description technique</label>
                                <textarea name="description" class="form-control border-2" rows="5" placeholder="Détails, dimensions, matériaux..."></textarea>
                            </div>
                        </div>

                        <div class="col-md-5 border-start ps-md-4">
                            <div class="mb-4">
                                <label class="form-label fw-bold"><i class="bi bi-image me-1"></i> Photo du produit</label>

                                <div id="preview-container" class="mb-3 d-none">
                                    <div class="position-relative d-inline-block">
                                        <img id="image-preview" src="#" alt="Aperçu" class="img-fluid rounded shadow-sm border" style="max-height: 200px; width: 100%; object-fit: contain; background: #fff;">
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="cursor:pointer" onclick="resetImage()">
                                            <i class="bi bi-x"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="image-upload-wrapper border-2 border-dashed rounded text-center p-4 bg-light" id="drop-zone">
                                    <i class="bi bi-cloud-arrow-up fs-1 text-primary" id="upload-icon"></i>
                                    <input type="file" name="image" class="form-control mt-3" id="imgInp" accept="image/*">
                                    <p class="text-muted small mt-2">Cliquez pour choisir une photo</p>
                                </div>
                            </div>

                            <div class="alert alert-info border-0 shadow-sm">
                                <i class="bi bi-info-circle-fill me-2"></i>
                                <strong>Conseil :</strong> Une belle photo augmente vos chances de vente sur WhatsApp !
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('admin.index') }}" class="btn btn-outline-secondary px-4">
                            <i class="bi bi-arrow-left"></i> Annuler
                        </a>
                        <button type="submit" class="btn btn-success px-5 py-2 fw-bold shadow-sm">
                            <i class="bi bi-check-lg me-1"></i> Enregistrer l'article
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
    .image-upload-wrapper:hover { background-color: #e9ecef !important; border-color: #0d6efd !important; }

    .form-control:focus, .form-select:focus {
        border-color: #0d6efd;
        box-shadow: none;
    }
    .card { border-radius: 15px; overflow: hidden; }
    .btn-success { background-color: #28a745; border: none; }
    .btn-success:hover { background-color: #218838; transform: translateY(-1px); }
</style>

<script>
    const imgInp = document.getElementById('imgInp');
    const imagePreview = document.getElementById('image-preview');
    const previewContainer = document.getElementById('preview-container');
    const uploadIcon = document.getElementById('upload-icon');

    // Fonction pour afficher l'aperçu
    imgInp.onchange = evt => {
        const [file] = imgInp.files;
        if (file) {
            imagePreview.src = URL.createObjectURL(file);
            previewContainer.classList.remove('d-none');

            // Changement d'icône pour confirmer la sélection
            uploadIcon.classList.replace('bi-cloud-arrow-up', 'bi-check-circle-fill');
            uploadIcon.classList.replace('text-primary', 'text-success');
        }
    }

    // Fonction pour réinitialiser l'image
    function resetImage() {
        imgInp.value = "";
        previewContainer.classList.add('d-none');
        uploadIcon.classList.replace('bi-check-circle-fill', 'bi-cloud-arrow-up');
        uploadIcon.classList.replace('text-success', 'text-primary');
    }
</script>
@endsection

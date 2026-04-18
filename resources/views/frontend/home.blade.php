<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quincaillerie KEÏT - Catalogue</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        :root {
            --bg-color: #f8f9fa;
            --card-bg: #ffffff;
            --text-color: #212529;
        }

        body.dark-theme {
            --bg-color: #121212;
            --card-bg: #1e1e1e;
            --text-color: #e0e0e0;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            transition: background-color 0.3s, color 0.3s;
        }

        .product-card {
            background-color: var(--card-bg);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }

        .dark-theme .card-title { color: #ffffff !important; }
        .dark-theme .text-muted { color: #aaaaaa !important; }

        .category-section h3 {
            color: #2c3e50;
        }

        .dark-theme .category-section h3 {
            color: #3498db;
        }

        /* ✅ MOBILE OPTIMIZATION */
        @media (max-width: 576px) {
            .product-card img {
                height: 160px !important;
            }

            h1 {
                font-size: 22px;
            }

            .card-title {
                font-size: 16px;
            }
        }

        @media (max-width: 992px) {
            form {
                width: 100% !important;
            }
        }
    </style>
</head>

<body>

<!-- NAVBAR RESPONSIVE -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow mb-4">
    <div class="container">

        <a class="navbar-brand fw-bold" href="/">QUINCAILLERIE KEÏT</a>

        <!-- bouton mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">

            <!-- SEARCH -->
            <form action="/" method="GET"
                  class="d-flex mx-lg-auto my-2 my-lg-0 w-100 w-lg-50">
                <input class="form-control me-2"
                       type="search"
                       name="search"
                       placeholder="Rechercher un outil..."
                       value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>

            <!-- ACTIONS -->
            <div class="d-flex gap-2 ms-lg-auto mt-2 mt-lg-0">
                <button class="btn btn-outline-light btn-sm" id="darkModeToggle">
                    <i class="bi bi-moon-stars"></i>
                </button>
                <div class="btn btn-outline-light btn-sm"></div>
                <!-- <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Admin</a> -->
            </div>

        </div>
    </div>
</nav>

<!-- CONTENT -->
<div class="container py-4">

    <h1 class="text-center mb-5 fw-bold">Notre Catalogue</h1>

    @if(request('search'))
        <div class="mb-4">
            <h4>Résultats pour : "{{ request('search') }}"</h4>
            <a href="/" class="btn btn-sm btn-link">Voir tout le catalogue</a>
        </div>
    @endif

    @foreach($categories as $category)
        @if($category->products->count() > 0)

            <div class="category-section mb-5">

                <h3 class="border-bottom pb-2 mb-4 fw-semibold">
                    <i class="bi bi-tag-fill me-2 text-primary"></i>
                    {{ $category->name }}
                </h3>

                <!-- GRID RESPONSIVE -->
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3 g-lg-4">

                    @foreach($category->products as $product)
                        <div class="col">

                            <div class="card h-100 shadow-sm border-0 product-card">

                                @if($product->image)
                                    <img src="{{ asset('storage/products/'.$product->image) }}"
                                         class="card-img-top p-2"
                                         alt="{{ $product->name }}"
                                         style="height: 200px; object-fit: contain;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center"
                                         style="height: 200px;">
                                        <span class="text-muted small">Sans image</span>
                                    </div>
                                @endif

                                <div class="card-body d-flex flex-column">

                                    <h5 class="card-title fw-bold mb-1">
                                        {{ $product->name }}
                                    </h5>

                                    <p class="card-text text-muted small mb-2 text-truncate">
                                        {{ $product->description }}
                                    </p>

                                    <div class="mt-auto">

                                        <div class="d-flex flex-wrap gap-1 mb-3">
                                            @foreach($product->prices as $price)
                                                <span class="badge bg-success fs-6">
                                                    {{ number_format($price->price, 0, ',', ' ') }} F
                                                </span>
                                            @endforeach
                                        </div>

                                        <a href="https://wa.me/+2250170985456?text=Bonjour, je suis intéressé par : {{ $product->name }}"
                                           class="btn btn-outline-success w-100 d-flex align-items-center justify-content-center gap-2"
                                           target="_blank">
                                            <i class="bi bi-whatsapp"></i> Commander
                                        </a>

                                    </div>

                                </div>
                            </div>

                        </div>
                    @endforeach

                </div>
            </div>

        @endif
    @endforeach

</div>

<!-- SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const toggleBtn = document.getElementById('darkModeToggle');
    const body = document.body;
    const icon = toggleBtn.querySelector('i');

    if (localStorage.getItem('dark-mode') === 'enabled') {
        body.classList.add('dark-theme');
        icon.classList.replace('bi-moon-stars', 'bi-sun');
    }

    toggleBtn.addEventListener('click', () => {
        body.classList.toggle('dark-theme');

        if (body.classList.contains('dark-theme')) {
            localStorage.setItem('dark-mode', 'enabled');
            icon.classList.replace('bi-moon-stars', 'bi-sun');
        } else {
            localStorage.setItem('dark-mode', 'disabled');
            icon.classList.replace('bi-sun', 'bi-moon-stars');
        }
    });
</script>

</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <title>Admin - Quincaillerie KEÏT</title>

    <style>
        body { background-color: #f4f6f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .navbar-brand { font-weight: bold; letter-spacing: 1px; }
        .nav-link-admin {
            color: rgba(255,255,255,0.8);
            font-weight: 500;
            transition: 0.3s;
            border-bottom: 2px solid transparent;
        }
        .nav-link-admin:hover, .nav-link-admin.active {
            color: #fff;
            border-bottom: 2px solid #ffc107;
        }
        .sub-nav { background: #2c3e50; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.index') }}">
                <i class="bi bi-tools me-2 text-warning"></i>ADMIN QUINCAILLERIE
            </a>

            <div class="d-flex align-items-center">
                <span class="text-white me-3 d-none d-md-inline small">
                    <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                </span>

                <a href="{{ route('home') }}" class="btn btn-sm btn-outline-light me-2" target="_blank">
                    <i class="bi bi-eye me-1"></i> Voir le site
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="bi bi-box-arrow-right me-1"></i> Déconnexion
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="sub-nav mb-4 shadow-sm">
        <div class="container d-flex">
            <a href="{{ route('admin.index') }}" class="nav-link-admin py-2 px-3 d-inline-block text-decoration-none {{ Request::is('admin/products*') || Request::is('admin') ? 'active' : '' }}">
                <i class="bi bi-box-seam me-1"></i> Articles
            </a>
            <a href="{{ route('admin.category.index') }}" class="nav-link-admin py-2 px-3 d-inline-block text-decoration-none {{ Request::is('admin/categories*') ? 'active' : '' }}">
                <i class="bi bi-grid me-1"></i> Catégories
            </a>
        </div>
    </div>

    <div class="container pb-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 border-start border-4 border-success" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 border-start border-4 border-danger" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

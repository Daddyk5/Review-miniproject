<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>🎬 Admin Panel - Movie Review</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Optional: Favicon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    {{-- Bootstrap 5.3 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    {{-- Bootstrap Icons (Optional for icons) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    {{-- Custom Admin CSS (Optional if needed) --}}
    <style>
        body {
            background-color: #121212;
            color: #e0e0e0;
        }

        .navbar-dark .navbar-brand, .navbar-dark .nav-link {
            color: #fff;
        }

        .navbar-dark .nav-link:hover {
            color: #ffcc00;
        }

        .card {
            background-color: #1e1e1e;
            color: #e0e0e0;
            border: 1px solid #333;
        }

        .btn-primary {
            background-color: #ffcc00;
            border-color: #ffcc00;
            color: #000;
        }

        .btn-primary:hover {
            background-color: #e6b800;
            border-color: #e6b800;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">🎬 Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.genres.index') }}"><i class="bi bi-film"></i> Genres</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.movies.index') }}"><i class="bi bi-camera-reels"></i> Movies</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.reviews.index') }}"><i class="bi bi-star-half"></i> Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.comments.index') }}"><i class="bi bi-chat-left-text"></i> Comments</a>
                    </li>
                    <li class="nav-item ms-3">
                        <a class="nav-link text-danger" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container py-4">
        <h1 class="text-center fw-bold mb-4">🛡️ Admin Panel</h1>
        @yield('content')
    </div>

    <!-- Footer (Optional) -->
    <footer class="text-center py-3 text-muted small">
        &copy; {{ date('Y') }} Movie Review System. All rights reserved.
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

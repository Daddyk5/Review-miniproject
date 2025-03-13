<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Admin Panel</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.genres.index') }}">Genres</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.movies.index') }}">Movies</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.reviews.index') }}">Reviews</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.comments.index') }}">Comments</a></li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content') {{-- Where admin pages will inject content --}}
    </div>
</body>
</html>

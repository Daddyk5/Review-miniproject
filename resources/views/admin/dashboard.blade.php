@extends('layouts.admin')

@section('content')

<h1 class="text-center fw-bold mb-4">🎬 Admin Dashboard</h1>

<p class="text-center mb-5">Welcome, Admin! Manage <strong>Movies</strong>, <strong>Genres</strong>, <strong>Reviews</strong>, and <strong>Comments</strong>.</p>

{{-- Management Cards --}}
<div class="row g-4 justify-content-center">
    @foreach ([
        ['route' => 'admin.genres.index', 'icon' => '🎞️', 'label' => 'Genres'],
        ['route' => 'admin.movies.index', 'icon' => '🎥', 'label' => 'Movies'],
        ['route' => 'admin.reviews.index', 'icon' => '⭐', 'label' => 'Reviews'],
        ['route' => 'admin.comments.index', 'icon' => '💬', 'label' => 'Comments'],
    ] as $item)
    <div class="col-md-3">
        <div class="card shadow-sm text-center">
            <div class="card-body">
                <h5>{{ $item['icon'] }} {{ $item['label'] }}</h5>
                <a href="{{ route($item['route']) }}" class="btn btn-outline-warning w-100">Manage {{ $item['label'] }}</a>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- Quick Stats --}}
<hr class="my-5">
<h4 class="fw-bold">📊 Quick Stats</h4>
<ul class="list-group list-group-flush mb-4">
    <li class="list-group-item bg-dark text-white"><strong>Total Movies:</strong> {{ $movieCount }}</li>
    <li class="list-group-item bg-dark text-white"><strong>Total Genres:</strong> {{ $genreCount }}</li>
    <li class="list-group-item bg-dark text-white"><strong>Total Reviews:</strong> {{ $reviewCount }}</li>
    <li class="list-group-item bg-dark text-white"><strong>Average Movie Rating:</strong> {{ number_format($averageRating, 1) }}/5</li>
</ul>

{{-- Conditional Analytics Chart --}}
@if ($movieCount > 0 || $genreCount > 0 || $reviewCount > 0 || $commentCount > 0)
    <h4 class="fw-bold mt-5">📊 Analytics Overview</h4>
    <div class="chart-container" style="position: relative; height: 400px;">
        <canvas id="statsChart"
                data-movie="{{ $movieCount }}"
                data-genre="{{ $genreCount }}"
                data-review="{{ $reviewCount }}"
                data-comment="{{ $commentCount }}"></canvas>
    </div>

    {{-- Chart.js CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const canvas = document.getElementById('statsChart');
        const ctx = canvas.getContext('2d');
        const movieCount = parseInt(canvas.dataset.movie);
        const genreCount = parseInt(canvas.dataset.genre);
        const reviewCount = parseInt(canvas.dataset.review);
        const commentCount = parseInt(canvas.dataset.comment);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Movies', 'Genres', 'Reviews', 'Comments'],
                datasets: [{
                    label: 'Total Counts',
                    data: [movieCount, genreCount, reviewCount, commentCount],
                    backgroundColor: ['#ffcc00', '#ff9900', '#66ccff', '#ff6666'],
                    borderColor: ['#e6b800', '#e68a00', '#4da6ff', '#ff3333'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // Make chart fully responsive
                scales: {
                    y: { 
                        beginAtZero: true,
                        ticks: { color: '#fff' }, // Make axis white for dark background
                        grid: { color: 'rgba(255, 255, 255, 0.2)' } // Grid lines light color
                    },
                    x: {
                        ticks: { color: '#fff' },
                        grid: { color: 'rgba(255, 255, 255, 0.2)' }
                    }
                },
                plugins: {
                    title: { 
                        display: true, 
                        text: 'Admin Overview (Movies, Genres, Reviews, Comments)',
                        color: '#fff'
                    },
                    legend: { display: false }
                }
            }
        });
    });
    </script>
@else
    <div class="alert alert-warning text-center mt-5">
        <strong>No analytics data available yet.</strong><br>
        Please add movies, genres, reviews, or comments to see the analytics chart.
    </div>
@endif

@endsection

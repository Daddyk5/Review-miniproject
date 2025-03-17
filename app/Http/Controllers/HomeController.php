<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Review;
use Illuminate\Support\Facades\Auth; // Make sure to import Auth facade

class HomeController extends Controller
{
    /**
     * Display the homepage with trending movies, recommended movies, and recent reviews.
     */
    public function index()
    {
        // Trending movies: Movies with reviews, ordered by rating
        $trendingMovies = Movie::where('reviews_count', '>', 0)
            ->orderByDesc('average_rating')
            ->take(8) // Top 8 trending movies
            ->get();

        // Recommended movies: Show best-rated movies for logged-in users
        $recommendedMovies = [];
        if (Auth::check()) { // ✅ Correct way using Facade
            $recommendedMovies = Movie::orderByDesc('average_rating')
                ->take(8) // Top 8 recommended
                ->get();
        }

        // Latest reviews: To display in "Recent Reviews" section
        $recentReviews = Review::with('user', 'movie')
            ->latest()
            ->take(5)
            ->get();

        // Pass all data to home page view
        return view('welcome', compact('trendingMovies', 'recommendedMovies', 'recentReviews'));
    }
}

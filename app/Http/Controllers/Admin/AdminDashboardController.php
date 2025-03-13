<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Genre;
use App\Models\Review;
use App\Models\Comment;

class AdminDashboardController extends Controller
{
    /**
     * Display the admin dashboard with stats.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.dashboard', [
            'movieCount'    => Movie::count(),
            'genreCount'    => Genre::count(),
            'reviewCount'   => Review::count(),
            'commentCount'  => Comment::count(),
            'averageRating' => Movie::avg('average_rating') ?? 0, // Avoid null values
        ]);
    }
}

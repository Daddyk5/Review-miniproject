<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserReviewController extends Controller
{
    public function showReviews(Movie $movie)
    {
        $reviews = $movie->reviews()->with('user', 'comments')->latest()->get();
        return view('user.review.index', compact('movie', 'reviews'));
    }

    public function store(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $movie->reviews()->create([
            'content' => $validated['content'],
            'rating' => $validated['rating'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('user.reviews', $movie)->with('success', 'Review added!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ReviewController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of reviews for a specific movie.
     */
    public function index(Movie $movie)
    {
        // Fetch all reviews related to the movie including user who posted
        $reviews = $movie->reviews()->with('user')->latest()->get();
        return response()->json($reviews, 200);
    }

    /**
     * Store a newly created review for a specific movie.
     */
    public function store(Request $request, Movie $movie)
    {
        // Validate incoming request
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
            'rating'  => 'required|integer|min:1|max:5', // Make rating required for consistent stats
        ]);

        // Create the review associated with movie and user
        $movie->reviews()->create([
            'content' => $validated['content'],
            'rating'  => $validated['rating'],
            'user_id' => Auth::id(), // Authenticated user
        ]);

        // Update movie's rating and review count
        $this->updateMovieStats($movie);

        return redirect()->back()->with('success', 'Review submitted successfully!');
    }

    /**
     * Display the specified review.
     */
    public function show(Review $review)
    {
        return response()->json($review->load('user', 'movie'), 200);
    }

    /**
     * Update the specified review.
     */
    public function update(Request $request, Review $review)
    {
        $this->authorize('update', $review); // Ensure only owner can update

        // Validate incoming request
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
            'rating'  => 'required|integer|min:1|max:5', // Required to adjust movie stats
        ]);

        $review->update($validated);

        // Update movie stats after review update
        $this->updateMovieStats($review->movie);

        return redirect()->back()->with('success', 'Review updated successfully!');
    }

    /**
     * Remove the specified review from storage.
     */
    public function destroy(Review $review)
    {
        $this->authorize('delete', $review); // Ensure only owner can delete

        $movie = $review->movie; // Keep reference to movie before deleting review
        $review->delete();

        // Update movie stats after deletion
        $this->updateMovieStats($movie);

        return redirect()->back()->with('success', 'Review deleted successfully!');
    }

    /**
     * Automatically update average rating and reviews count for a movie.
     */
    private function updateMovieStats(Movie $movie): void
    {
        $movie->average_rating = $movie->reviews()->avg('rating') ?? 0;
        $movie->reviews_count = $movie->reviews()->count();
        $movie->save();
    }
}

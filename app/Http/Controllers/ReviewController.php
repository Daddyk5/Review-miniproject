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
        $reviews = $movie->reviews()->with('user')->get();
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
            'rating'  => 'nullable|integer|min:1|max:5',
        ]);

        // Create the review with relation to movie and user
        $review = $movie->reviews()->create([
            'content' => $validated['content'],
            'rating'  => $validated['rating'] ?? null,
            'user_id' => Auth::id(), // Authenticated user
        ]);

        // Return the created review with user info
        return response()->json($review->load('user'), 201);
    }

    /**
     * Display the specified review.
     */
    public function show(Review $review)
    {
        // Load related user and movie
        return response()->json($review->load('user', 'movie'), 200);
    }

    /**
     * Update the specified review.
     */
    public function update(Request $request, Review $review)
    {
        // Authorize the action, ensure only the owner can update
        $this->authorize('update', $review);

        // Validate incoming request
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
            'rating'  => 'nullable|integer|min:1|max:5',
        ]);

        // Update review
        $review->update($validated);

        // Return updated review
        return response()->json($review, 200);
    }

    /**
     * Remove the specified review from storage.
     */
    public function destroy(Review $review)
    {
        // Authorize the action, ensure only the owner can delete
        $this->authorize('delete', $review);

        // Delete review
        $review->delete();

        // Return success message
        return response()->json(['message' => 'Review deleted successfully'], 200);
    }
}

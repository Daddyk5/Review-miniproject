<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    // Get all movies
    public function index()
    {
        return response()->json(Movie::all(), 200);
    }

    // Create a new movie
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'poster' => 'nullable|string', // This can be URL or file path
        ]);

        $movie = Movie::create($validated);
        return response()->json($movie, 201);
    }

    // Show a specific movie
    public function show(Movie $movie)
    {
        return response()->json($movie, 200);
    }

    // Update a movie
    public function update(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'poster' => 'nullable|string',
        ]);

        $movie->update($validated);
        return response()->json($movie, 200);
    }

    // Delete a movie
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return response()->json(['message' => 'Movie deleted successfully'], 200);
    }
}

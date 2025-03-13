<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Http\Request;

class AdminMovieController extends Controller
{
    // ✅ List Movies
    public function index()
    {
        $movies = Movie::with('genres')->paginate(10);
        return view('admin.movies.index', compact('movies'));
    }

    // ✅ Create Movie Form
    public function create()
    {
        $genres = Genre::all();
        return view('admin.movies.create', compact('genres'));
    }

    // ✅ Store Movie
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // ✅ validate image
            'genres' => 'array',
        ]);

        // ✅ Handle file upload
        $posterPath = null;
        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters', 'public'); // Store in storage/app/public/posters
        }

        $movie = Movie::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'poster' => $posterPath,
        ]);

        $movie->genres()->sync($validated['genres'] ?? []);

        return redirect()->route('admin.movies.index')->with('success', 'Movie added successfully!');
    }

    // ✅ Edit Movie Form
    public function edit(Movie $movie)
    {
        $genres = Genre::all();
        return view('admin.movies.edit', compact('movie', 'genres'));
    }

    // ✅ Update Movie
    public function update(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'genres' => 'array',
        ]);

        // ✅ Handle updated file upload
        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters', 'public');
            $movie->poster = $posterPath;
        }

        $movie->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
        ]);

        $movie->genres()->sync($validated['genres'] ?? []);

        return redirect()->route('admin.movies.index')->with('success', 'Movie updated successfully!');
    }

    // ✅ Delete Movie
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()->route('admin.movies.index')->with('success', 'Movie deleted successfully.');
    }
}

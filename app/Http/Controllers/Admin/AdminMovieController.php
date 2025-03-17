<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminMovieController extends Controller
{
    // ✅ List Movies
    public function index()
    {
        $movies = Movie::with('genres')->latest()->paginate(10);
        return view('admin.movies.index', compact('movies'));
    }

    // ✅ Show Create Movie Form
    public function create()
    {
        $genres = Genre::all();
        return view('admin.movies.create', compact('genres'));
    }

    // ✅ Store Movie
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'poster'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'genres'      => 'required|array|min:1',
        ]);

        if ($request->hasFile('poster')) {
            $data['poster'] = $request->file('poster')->store('posters', 'public');
        }

        $movie = Movie::create([
            'title'       => $data['title'],
            'description' => $data['description'] ?? null,
            'poster'      => $data['poster'] ?? null,
        ]);

        $movie->genres()->attach($data['genres']);

        return redirect()->route('admin.movies.index')->with('success', 'Movie added successfully!');
    }

    // ✅ Show Edit Form
    public function edit(Movie $movie)
    {
        $genres = Genre::all();
        return view('admin.movies.edit', compact('movie', 'genres'));
    }

    // ✅ Update Movie
    public function update(Request $request, Movie $movie)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'poster'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'genres'      => 'required|array|min:1',
        ]);

        // Handle new poster upload and delete old one if exists
        if ($request->hasFile('poster')) {
            if ($movie->poster && Storage::disk('public')->exists($movie->poster)) {
                Storage::disk('public')->delete($movie->poster);
            }
            $data['poster'] = $request->file('poster')->store('posters', 'public');
        }

        // Update movie data
        $movie->update([
            'title'       => $data['title'],
            'description' => $data['description'] ?? null,
            'poster'      => $data['poster'] ?? $movie->poster,
        ]);

        // Sync genres
        $movie->genres()->sync($data['genres']);

        return redirect()->route('admin.movies.index')->with('success', 'Movie updated successfully!');
    }

    // ✅ Delete Movie
    public function destroy(Movie $movie)
    {
        // Delete poster file if exists
        if ($movie->poster && Storage::disk('public')->exists($movie->poster)) {
            Storage::disk('public')->delete($movie->poster);
        }

        // Detach genres
        $movie->genres()->detach();

        // Delete movie
        $movie->delete();

        return redirect()->route('admin.movies.index')->with('success', 'Movie deleted successfully.');
    }
}

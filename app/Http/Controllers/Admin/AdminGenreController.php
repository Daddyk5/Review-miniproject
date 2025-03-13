<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class AdminGenreController extends Controller
{
    // List Genres
    public function index()
    {
        $genres = Genre::paginate(10); // Paginate genres
        return view('admin.genres.index', compact('genres'));
    }

    // Store Genre
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        Genre::create(['name' => $request->name]);

        return redirect()->back()->with('success', 'Genre created successfully.');
    }

    // Delete Genre
    public function destroy(Genre $genre)
    {
        $genre->delete();
        return redirect()->back()->with('success', 'Genre deleted successfully.');
    }
}

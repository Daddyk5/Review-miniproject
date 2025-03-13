<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a paginated list of movies with their genres.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Optional query for search in main index as well
        $query = $request->input('query');

        $movies = Movie::with('genres')
            ->when($query, function ($q) use ($query) {
                $q->where('title', 'like', '%' . $query . '%');
            })
            ->paginate(10); // Paginated list

        return view('user.movies.index', compact('movies', 'query'));
    }

    /**
     * Display the specified movie's details, including genres and reviews.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\View\View
     */
    public function show(Movie $movie)
    {
        // Eager load genres and reviews with user data
        $movie->load('genres', 'reviews.user');

        return view('user.movies.show', compact('movie'));
    }

    /**
     * Search movies by title or description with pagination.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function search(Request $request)
    {
        $query = $request->input('query', ''); // Default empty if no query

        $movies = Movie::with('genres')
            ->where('title', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->paginate(10);

        return view('user.movies.search-results', compact('movies', 'query'));
    }
}

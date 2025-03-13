<?php

namespace App\Http\Controllers;

use App\Models\Movie;

class HomeController extends Controller
{
    public function index()
    {
        $movies = Movie::latest()->take(8)->get(); // Latest 8 movies
        return view('welcome', compact('movies'));
    }
}

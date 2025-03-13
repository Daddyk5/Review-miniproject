<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;

class AdminReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ✅ Paginate instead of get() or all()
        $reviews = Review::with(['movie', 'user'])->latest()->paginate(10); // 10 per page

        return view('admin.reviews.index', compact('reviews'));
    }

    // Other methods can remain empty or for future
}

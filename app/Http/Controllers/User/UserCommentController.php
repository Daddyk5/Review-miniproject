<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCommentController extends Controller
{
    public function showComments(Review $review)
    {
        $comments = $review->comments()->with('user')->latest()->get();
        return view('user.comment.index', compact('review', 'comments'));
    }

    public function store(Request $request, Review $review)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $review->comments()->create([
            'content' => $validated['content'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('user.comments', $review)->with('success', 'Comment added!');
    }
}

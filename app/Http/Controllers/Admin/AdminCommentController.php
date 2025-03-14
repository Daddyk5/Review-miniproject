<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;

class AdminCommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with('user', 'review')->paginate(10);
        return view('admin.comments.index', compact('comments'));
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
}

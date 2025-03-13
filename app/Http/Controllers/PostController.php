<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display all posts.
     */
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);
        return view('user.posts.index', compact('posts'));
    }

    /**
     * Show form to create a post.
     */
    public function create()
    {
        return view('user.posts.create');
    }

    /**
     * Store a newly created post.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('post_images', 'public');
        }

        Post::create([
            'user_id' => Auth::id(),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'image' => $imagePath,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    /**
     * Show form to edit a post.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post); // Optional if using policy
        return view('user.posts.edit', compact('post'));
    }

    /**
     * Update the post.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post); // Optional if using policy

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $post->image = $request->file('image')->store('post_images', 'public');
        }

        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Delete the post.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post); // Optional if using policy

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}

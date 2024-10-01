<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the posts.
     */
    public function index()
    {
        $posts = Post::with('user', 'categories')->get();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new post.
     */
    public function create()
    {
        $users = User::all();
        $categories = Category::all();
        return view('posts.create', compact('users', 'categories'));
    }

    /**
     * Store a newly created post in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'user_id' => 'required|exists:users,id',
            'categories' => 'required|array',
        ]);

        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
        ]);

        // Attach categories
        $post->categories()->attach($request->categories);

        return redirect()->route('posts.index')->with('success', 'Пост успішно створений.');
    }

    /**
     * Show the form for editing the specified post.
     */
    public function edit(Post $post)
    {
        $users = User::all();
        $categories = Category::all();
        return view('posts.edit', compact('post', 'users', 'categories'));
    }

    /**
     * Update the specified post in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'user_id' => 'required|exists:users,id',
            'categories' => 'required|array',
        ]);

        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
        ]);

        // Sync categories
        $post->categories()->sync($request->categories);

        return redirect()->route('posts.index')->with('success', 'Пост успішно оновлений.');
    }

    /**
     * Remove the specified post from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Пост успішно видалений.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user', 'categories')->get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $users = User::all();
        $categories = Category::all();
        return view('posts.create', compact('users', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'required',
                'string',
            ],
            'user_id' => [
                'required',
                'exists:users,id',
            ],
            'categories' => [
                'required',
                'array',
            ],
        ]);

        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
        ]);

        $post->categories()->attach($request->categories);

        return redirect()->route('posts.index')->with('success', 'Пост успішно створений.');
    }

    public function show(Post $post, Request $request)
    {
        $users = User::all();
        $selectedUserId = $request->input('selected_user', $users->first()->id);
        $isLiked = $post->likes()->where('user_id', $selectedUserId)->exists();
        $comments = $post->comments()->with('user')->get();
    
        return view('posts.show', compact('post', 'users', 'selectedUserId', 'isLiked', 'comments'));
    }

    public function edit(Post $post)
    {
        $users = User::all();
        $categories = Category::all();
        return view('posts.edit', compact('post', 'users', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'required',
                'string',
            ],
            'user_id' => [
                'required',
                'exists:users,id',
            ],
            'categories' => [
                'required',
                'array',
            ],
        ]);

        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
        ]);

        $post->categories()->sync($request->categories);

        return redirect()->route('posts.index')->with('success', 'Пост успішно оновлений.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Пост успішно видалений.');
    }
}

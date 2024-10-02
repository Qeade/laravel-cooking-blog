<?php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'user_id' => [
                'required',
                'exists:users,id',
            ],
            'text' => [
                'required',
                'string',
                'max:500',
            ],
        ]);

        $post->comments()->create([
            'user_id' => $request->user_id,
            'text' => $request->text,
        ]);

        return redirect()->route('posts.show', ['post' => $post->id, 'selected_user' => $request->user_id])
                         ->with('success', 'Коментар додано успішно!');
    }

    
}

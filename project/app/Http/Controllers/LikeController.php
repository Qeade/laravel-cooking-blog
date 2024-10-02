<?php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Post $post, $userId)
    {
        if (!$post->likes()->where('user_id', $userId)->exists()) {
            $post->likes()->create(['user_id' => $userId]);
        }

        return redirect()->route('posts.show', ['post' => $post->id, 'selected_user' => $userId]);
    }

    public function destroy(Post $post, $userId)
    {
        $post->likes()->where('user_id', $userId)->delete();

        return redirect()->route('posts.show', ['post' => $post->id, 'selected_user' => $userId]);
    }
}

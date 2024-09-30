<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
    ];

    /**
     * Відношення з моделлю User (кожен лайк належить одному користувачу).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Відношення з моделлю Post (кожен лайк належить одному посту).
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}

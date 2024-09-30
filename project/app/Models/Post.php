<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'photo',
        'user_id',
    ];

    /**
     * Відношення з моделлю User (кожен пост належить одному користувачу).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Відношення з моделлю Comment (кожен пост може мати багато коментарів).
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Відношення з моделлю Like (кожен пост може мати багато лайків).
     */
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Відношення з моделлю Category (кожен пост може належати до багатьох категорій).
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'categories_and_posts');
    }
}

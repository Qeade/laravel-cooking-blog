<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * Відношення з моделлю Post (кожна категорія може мати багато постів).
     */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'categories_and_posts');
    }
}

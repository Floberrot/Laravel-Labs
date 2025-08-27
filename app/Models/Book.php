<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Book extends Model
{
    protected $fillable = ['title', 'author', 'published_at'];
    protected $casts = [
        'published_at' => 'datetime'
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function detail(): HasOne
    {
        return $this->hasOne(BookDetail::class);
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'book_tags')->withTimestamps()
            ->withPivot('weight');
    }

    protected function publishedAt(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value) => new \DateTime($value)->format('Y-m-d')
        );
    }

    protected function title(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value) => \Str::ucfirst($value),
            set: fn(mixed $value) => \Str::lower($value)
        );
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value) => new \DateTime($value)->format('Y-m-d H:i:s')
        );
    }

    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value) => new \DateTime($value)->format('Y-m-d H:i:s')
        );
    }
}


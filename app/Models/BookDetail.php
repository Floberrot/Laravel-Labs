<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookDetail extends Model
{
    protected $fillable = ['isbn', 'pages'];
    protected $casts = [
        'isbn' => 'string',
        'pages' => 'integer'
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}

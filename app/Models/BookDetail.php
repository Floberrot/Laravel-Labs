<?php

namespace App\Models;

use App\ValueObject\Price\Price;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookDetail extends Model
{
    protected $fillable = ['isbn', 'pages', 'price'];
    protected $casts = [
        'isbn' => 'string',
        'pages' => 'integer',
        'price' => Price::class
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}

<?php

namespace App\Models;

use App\ValueObject\Price\Price;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookDetail extends Model
{
    use HasFactory;

    protected $fillable = ['isbn', 'pages', 'price'];
    protected $casts = [
        'isbn' => 'string',
        'pages' => 'integer',
        'price' => Price::class
    ];
    protected $appends = ['pages_human'];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    protected function pagesHuman(): Attribute
    {
        return Attribute::make(
            get: fn() => "There are {$this->pages} pages in this book"
        );
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $fillable = ['content', 'approved'];
    protected $casts = [
        'approved' => 'boolean'
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}

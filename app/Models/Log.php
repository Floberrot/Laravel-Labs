<?php

namespace App\Models;

use App\Enums\LogTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $table = 'logs';
    protected $fillable = ['message', 'type'];

    protected $casts = [
        'type' => LogTypeEnum::class,
    ];
}

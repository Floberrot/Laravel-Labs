<?php

namespace App\Models;

use App\Events\PostSaved;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Post extends Model
{
    use Notifiable;

    protected $dispatchesEvents = [
        'saved' => PostSaved::class,
    ];
    protected $fillable = ['title', 'description'];

}

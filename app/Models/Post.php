<?php

namespace App\Models;

use App\Events\PostSaved;
use App\Observers\PostObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

#[ObservedBy(PostObserver::class)]
class Post extends Model
{
    use Notifiable;

    protected $dispatchesEvents = [
        'saved' => PostSaved::class,
    ];
    protected $fillable = ['title', 'description'];

}

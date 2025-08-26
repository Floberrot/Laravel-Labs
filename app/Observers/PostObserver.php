<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Log;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function created(Post $log): void
    {
        Log::emergency('NEW LOG DETECTED !!! ' . json_encode($log));
    }

    /**
     * Handle the Log "updated" event.
     */
    public function updated(Post $log): void
    {
        //
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $log): void
    {
        //
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $log): void
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $log): void
    {
        //
    }
}

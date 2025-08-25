<?php

namespace App\Listeners;

use App\Events\PostSaved;
use Illuminate\Support\Facades\Log;

class LogPostSaved
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PostSaved $event): void
    {
        Log::info("The post bellow has been added to database \n" . json_encode($event->post));
    }
}

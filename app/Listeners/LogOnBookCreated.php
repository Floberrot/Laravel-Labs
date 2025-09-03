<?php

namespace App\Listeners;

use App\Events\BookCreated;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogOnBookCreated implements ShouldQueue
{
    use Queueable;
    use InteractsWithQueue;

    public int $tries = 3;
    public int $backoff = 60;

    /**
     * Handle the event.
     */
    public function handle(BookCreated $event): void
    {
        Log::info("Book has just been created", ['book' => $event->book]);

        // Here I will end an email.
    }

    public function viaQueue(): string
    {
        return 'send-log';
    }
}

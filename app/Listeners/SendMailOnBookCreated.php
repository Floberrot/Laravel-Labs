<?php

namespace App\Listeners;

use App\Events\BookCreated;
use App\Mail\BookCreatedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailOnBookCreated implements ShouldQueue
{
    use InteractsWithQueue;

    public int $tries = 3;
    public int $backoff = 60;

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
    public function handle(BookCreated $event): void
    {
        $to = config('mail.book_created_to', 'dev@example.com');
        Mail::to($to)->send(new BookCreatedMail($event->book));
    }
}

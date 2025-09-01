<?php

namespace App\Listeners;

use App\Events\BookCreated;
use App\Mail\BookCreatedMail;
use Illuminate\Support\Facades\Mail;

class SendMailOnBookCreated
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
    public function handle(BookCreated $event): void
    {
        $to = config('mail.book_created_to', 'dev@example.com');
        Mail::to($to)->send(new BookCreatedMail($event->book));
    }
}

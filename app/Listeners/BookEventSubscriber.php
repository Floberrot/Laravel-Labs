<?php

namespace App\Listeners;

use App\Events\BookRetrieved;
use Illuminate\Events\Dispatcher;

class BookEventSubscriber
{

    public function subscribe(Dispatcher $events): array
    {
        return [
            BookRetrieved::class => 'handleBookRetrieved',
        ];
    }

    public function handleBookRetrieved(BookRetrieved $event): void
    {
        \Illuminate\Support\Facades\Log::alert('A new Log has been retrieved !! : ' . $event->book);
    }
}

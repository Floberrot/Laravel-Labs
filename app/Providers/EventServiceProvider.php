<?php

namespace App\Providers;

use App\Events\BookCreated;
use App\Listeners\BookEventSubscriber;
use App\Listeners\LogOnBookCreated;
use App\Listeners\SendMailOnBookCreated;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        BookCreated::class => [
            LogOnBookCreated::class,
            SendMailOnBookCreated::class,
        ],
    ];

    protected $subscribe = [
        BookEventSubscriber::class

    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

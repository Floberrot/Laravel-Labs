<?php

use App\Jobs\SendHeartbeat;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
Schedule::command('app:check-duplicate-books')->everyFiveSeconds();
// Every 10 seconds, publish a message on queue heart-beat. If worker is running during this, every ten seconds, it cans
// consume these messages.
Schedule::job(new SendHeartbeat, 'heart-beat', 'rabbitmq')->everyFiveSeconds();

<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendHeartbeat implements ShouldQueue
{
    use Queueable;
    use Dispatchable;
    use InteractsWithQueue;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::alert('Boum boum...');
    }

    public function viaQueue(): string
    {
        return 'heart-beat';
    }
}

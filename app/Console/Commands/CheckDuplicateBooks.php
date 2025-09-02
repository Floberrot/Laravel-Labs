<?php

namespace App\Console\Commands;

use App\Jobs\DeleteDuplicateBooks;
use Illuminate\Console\Command;

class CheckDuplicateBooks extends Command
{

    protected $signature = 'app:check-duplicate-books';


    protected $description = 'Check if some books are duplicated in database with their title';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        DeleteDuplicateBooks::dispatch();
    }
}

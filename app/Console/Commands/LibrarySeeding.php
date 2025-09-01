<?php

namespace App\Console\Commands;

use App\Models\Book;
use App\Models\BookDetail;
use App\Models\Tag;
use Database\Seeders\LibrarySeeder;
use Illuminate\Console\Command;

class LibrarySeeding extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = ' app:library-seeding {--fresh : Reset la base avant de reseeder}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed la base avec des livres, détails et tags via LibrarySeeder et affiche un récap';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($this->option('fresh')) {
            $this->call('migrate:fresh');
        }

        $this->call(LibrarySeeder::class);

        $this->info('--- Récapitulatif ---');
        $this->line('Books       : ' . Book::count());
        $this->line('BookDetails : ' . BookDetail::count());
        $this->line('Tags        : ' . Tag::count());

        $countPivot = \DB::table('book_tags')->count();
        $this->line('Pivot (book_tag): ' . $countPivot);

        return self::SUCCESS;
    }
}

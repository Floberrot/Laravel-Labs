<?php

namespace Database\Seeders;

use App\Enums\TagEnum;
use App\Models\Book;
use App\Models\BookDetail;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class LibrarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::factory()->count(10)
            ->unavailable()
            ->has(BookDetail::factory(), 'detail')
            ->create();

        Book::factory()->count(50)
            ->available()
            ->has(BookDetail::factory(), 'detail')
            ->create();

        $tags = collect(TagEnum::cases())
            ->map(fn($e) => Tag::firstOrCreate(['name' => $e->value]));

        foreach (Book::all() as $book) {
            $pick = $tags->random(rand(1, $tags->count()))->pluck('id')->all();
            $book->tags()->syncWithoutDetaching($pick);
        }
    }
}

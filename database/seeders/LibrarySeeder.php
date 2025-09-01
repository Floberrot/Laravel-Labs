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
        Book::factory()->count(50)
            ->has(BookDetail::factory(), 'detail')
            ->create();

        $bd = Tag::factory()->create([
            'name' => TagEnum::BD
        ]);
        $manga = Tag::factory()->create([
            'name' => TagEnum::MANGA
        ]);
        $graphicBook = Tag::factory()->create([
            'name' => TagEnum::GRAPHIC_BOOK
        ]);

        $tags = [$bd, $manga, $graphicBook];

        foreach (Book::all() as $book) {
            $book->tags()->attach($tags[array_rand($tags)]);
        }
    }
}

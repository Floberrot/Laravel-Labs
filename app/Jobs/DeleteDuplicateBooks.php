<?php

namespace App\Jobs;

use App\Models\Book;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class DeleteDuplicateBooks
{
    use Dispatchable;


    public function handle(): void
    {

        $titles = [];
        $count = 0;
        foreach (Book::cursor() as $book) {
            if (!in_array($book->title, $titles)) {
                $titles[] = $book->title;
                Log::info("Book id {$book->id} is not duplicated, try another one.");
                continue;
            }

            Log::info("The book id {$book->id} already exists with the title {$book->title}. Deletion...");
            $book->delete();
            $count++;
        }

        unset($titles);
        Log::info("all books has been checked. $count books has been deleted");
    }
}

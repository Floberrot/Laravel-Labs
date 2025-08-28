<?php

namespace App\Http\Resources;

use App\ISBNFormatTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookDetailResource extends JsonResource
{
    use ISBNFormatTrait;

    /**
     * @throws \Exception
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'isbn_conventional' => $this->toIsbn($this->isbn),
            'isbn' => $this->isbn,
            'pages' => $this->pages,
            'pages_human' => $this->pagesHuman,
            'price' => $this->price
        ];
    }
}

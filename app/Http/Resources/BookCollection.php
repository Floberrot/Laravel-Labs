<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BookCollection extends ResourceCollection
{
    public $collects = BookResource::class;

    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection
        ];
    }

    public function with($request): array
    {
        return ['meta' => [
            'message' => 'custom meta'
        ]];
    }
}

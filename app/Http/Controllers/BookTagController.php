<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookTagController extends Controller
{
    public function index(Book $book): JsonResponse
    {
        return response()->json([
            'book' => $book->only(['id', 'title']),
            'tags' => $book->tags()->orderBy('name')->get(['tags.id', 'name', 'weight']),
        ]);
    }

    public function attach(Request $r, Book $book): JsonResponse
    {
        $ids = $r->validate([
            'tags' => 'required|array',
            'tags.*.tag_id' => 'integer|exists:tags,id',
            'tags.*.weight' => 'sometimes|integer'
        ])['tags'];

        $book->tags()->attach($ids);

        return response()->json([
            'tags' => $book->tags()->orderBy('name')->get(['tags.id', 'name']),
        ], Response::HTTP_CREATED);
    }

    public function sync(Request $r, Book $book): JsonResponse
    {
        $ids = $r->validate([
            'tags' => 'required|array',
            'tags.*.tag_id' => 'integer|exists:tags,id',
            'tags.*.weight' => 'sometimes|integer'
        ])['tags'];

        $book->tags()->sync($ids);

        return response()->json([
            'tags' => $book->tags()->orderBy('name')->get(['tags.id', 'name']),
        ]);
    }

    public function detach(Book $book, Tag $tag): JsonResponse
    {
        $book->tags()->detach($tag->id);
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}

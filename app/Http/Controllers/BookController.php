<?php

namespace App\Http\Controllers;

use App\Events\BookCreated;
use App\Events\BookRetrieved;
use App\Http\Requests\PatchBookRequest;
use App\Http\Requests\PostBookRequest;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        if (!$request->boolean('groupByDate')) {
            $books = Book::with('detail')->orderByDesc('published_at')->paginate(10);

            return new BookCollection($books)->response();
        }

        $books = Book::all();
        $filtered = $books
            ->filter(fn(Book $book) => $book->available)
            ->map(fn(Book $book) => [
                'title' => $book->title,
                'author' => $book->author,
                'published_at' => $book->published_at,
            ])
            ->groupBy(fn($book) => new \DateTime($book['published_at'])->format('Y'))
            ->sortKeysDesc()
            ->map(fn($group, $year) => ['year' => (int)$year, 'books' => $group->values()])
            ->values();

        return response()->json($filtered);

    }

    public function store(PostBookRequest $request): JsonResponse
    {
        $book = Book::create($request->validated());
        BookCreated::dispatch($book);

        return response()->json([
            'message' => 'Book created',
            'book' => $book,
        ], Response::HTTP_CREATED);
    }

    public function show(Book $book): JsonResponse
    {
        BookRetrieved::dispatch($book);
        return new BookResource($book)->response();
    }

    public function update(PatchBookRequest $request, Book $book): JsonResponse
    {
        $book->update($request->validated());

        return response()->json([
            'message' => 'Book updated',
            'book' => $book->fresh(),
        ], Response::HTTP_OK);
    }

    public function destroy(Book $book): JsonResponse
    {
        $book->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}

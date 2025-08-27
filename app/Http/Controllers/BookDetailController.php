<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookDetailRequest;
use App\Http\Requests\UpdateBookDetailRequest;
use App\Models\Book;
use App\Models\BookDetail;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class BookDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Book $book): JsonResponse
    {
        return response()->json([
            'message' => "Book detail for " . $book->title,
            'book_detail' => $book->detail()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookDetailRequest $request, Book $book): JsonResponse
    {
        $book->detail()->create($request->validated());

        return response()->json([
            'message' => "Thanks for adding details on " . $book->title,
            'book_detail' => $book->detail()
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(BookDetail $bookDetail)
    {
        return response()->json([
            'message' => "Book detail of " . $bookDetail->book->title,
            'book_detail' => $bookDetail
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookDetailRequest $request, BookDetail $bookDetail)
    {
        $bookDetail->update($request->validated());

        return response()->json([
            'message' => "Update done !",
            'book_detail' => $bookDetail->fresh()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookDetail $bookDetail)
    {
        $title = $bookDetail->book->title;

        $bookDetail->delete();

        return response()->json([
            'message' => "You have deleted details for $title",
            'book_detail' => $bookDetail->fresh()
        ], Response::HTTP_NO_CONTENT);
    }
}

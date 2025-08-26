<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatchCommentRequest;
use App\Http\Requests\PostCommentRequest;
use App\Models\Book;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Book $book): JsonResponse
    {
        return response()->json([
            'book' => $book,
            'comments' => $book->comments()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCommentRequest $request, Book $book): JsonResponse
    {
        $book->comments()->create($request->validated());
        return response()->json([
            'book' => $book,
            'comments' => $book->comments()->get()
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return response()->json([
            'comment' => $comment
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PatchCommentRequest $request, Comment $comment)
    {
        $comment->update($request->validated());

        return response()->json([
            'comment' => $comment->fresh()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}

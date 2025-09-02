<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadBookCoverRequest;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Storage;

class BookCoverController extends Controller
{
    public function store(UploadBookCoverRequest $request, Book $book): JsonResponse
    {
        $disk = Storage::disk('b2');
        $ext = $request->file('cover')->extension();
        $path = "books/{$book->id}/cover.{$ext}";

        $disk->putFileAs(dirname($path), $request->file('cover'), basename($path), [
            'visibility' => 'private',
        ]);

        $book->forceFill(['cover_path' => $path])->save();

        $publicUrl = $disk->url($path);

        return response()->json([
            'message' => 'Cover uploaded',
            'cover_path' => $path,
            'cover_url' => $publicUrl,
        ], 201);
    }

    public function destroy(Book $book): JsonResponse
    {
        if ($book->cover_path) {
            Storage::disk('b2')->delete($book->cover_path); // ou 'r2'
            $book->forceFill(['cover_path' => null])->save();
        }

        return response()->json(['message' => 'Cover deleted']);
    }

    public function showSignedUrl(Book $book): JsonResponse
    {
        abort_if(!$book->cover_path, 404);
        $url = Storage::disk('b2')->temporaryUrl($book->cover_path, now()->addMinutes(15));
        return response()->json(['url' => $url]);
    }
}

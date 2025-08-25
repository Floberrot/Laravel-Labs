<?php

namespace App\Http\Controllers;

use App\Events\PostSaved;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    public function store(PostRequest $request): JsonResponse
    {
        $data = $request->validated();

        try {
            $post = Post::create($data);
            PostSaved::dispatch($post);
            return response()->json([
                'post' => $post
            ], 201);
        } catch (\Throwable $t) {
            return response()->json([
                'error' => $t->getMessage()
            ], 422);
        }
    }

    public function index(): JsonResponse
    {
        $posts = Post::all();

        return response()->json([
            'posts' => $posts
        ]);
    }

    public function show(int $id): JsonResponse
    {
        try {
            $post = Post::findOrFail($id);
            return response()->json([
                'post' => $post
            ]);
        } catch (\Exception $t) {
            return response()->json([
                'error' => $t->getMessage()
            ], 404);
        }
    }
}

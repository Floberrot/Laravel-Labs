<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(PostRequest $request): JsonResponse
    {
        $data = $request->validated();

        try {
            $post = Post::create($data);

            return response()->json([
                'post' => $post
            ], 201);
        } catch (\Throwable $t) {
            return response()->json([
                'error' => $t->getMessage()
            ], 422);
        }
    }
}

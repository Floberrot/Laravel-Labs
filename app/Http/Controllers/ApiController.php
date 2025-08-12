<?php

namespace App\Http\Controllers;

use App\Dto\Post;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        try {
            $post = Post::fromRequest($request);
            return new JsonResponse(
                ['post' => $post],
                200
            );
        } catch (\Exception $e) {
            return new JsonResponse(
                ['errors' => $e->getMessage() . $e->getLine() . $e->getFile()],
                422
            );
        }
    }
}

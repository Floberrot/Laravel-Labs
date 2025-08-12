<?php

namespace App\Http\Controllers;

use App\Dto\Post;
use App\Http\Resources\PostResource;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        try {
            return new JsonResponse(new PostResource(Post::fromRequest($request)), 200);
        } catch (\Exception $e) {
            return new JsonResponse(
                ['errors' => $e->getMessage() . $e->getLine() . $e->getFile()],
                422
            );
        }
    }
}

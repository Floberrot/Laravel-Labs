<?php

namespace App\Http\Controllers;

use App\Dto\Post;
use App\Exceptions\InvalidUsernameException;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Validator;
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

    public function register(RegisterRequest $request): JsonResponse
    {
        // without form request
        //        $validator = Validator::make($request->all(), [
        //            'name' => 'required|string|max:50',
        //            'email' => 'required|email',
        //            'password' => 'required|string|min:8',
        //        ]);
        //
        //        if ($validator->fails()) {
        //            return response()->json([
        //                'errors' => $validator->errors(),
        //            ], 422);
        //        }
        $data = $request->validated();

        if ($data['username'] === $data['name']) {
            throw new InvalidUsernameException($data['username']);
        }

        return response()->json([
            'message' => 'User registered successfully',
            'data' => $data,
        ]);
    }
}

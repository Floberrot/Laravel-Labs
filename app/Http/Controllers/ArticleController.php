<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    private const array ARTICLES = ['first', 'second', 'third'];

    public function index(Request $request): JsonResponse
    {
        $limit = (int) $request->query('limit', 10);

        return response()->json([
            'limit' => $limit,
            'articles' => array_slice(self::ARTICLES, 0, $limit)
        ]);
    }

    public function show(string $slug): JsonResponse
    {
        $header = request()->header('X-Trace-Id') ?? 'none';
        $lowerSlug = strtolower($slug);
        abort_unless(in_array($lowerSlug, self::ARTICLES, true), 404, "Article {$slug} not found");
        return response()->json([
            'articles' => $slug
        ])
            ->header('X-Trace-Id', $header);
    }
}

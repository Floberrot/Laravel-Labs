<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(): array
    {
        return ['message' => 'index'];
    }

    public function show(int $id): array
    {
        return ['message' => "show $id"];
    }
}

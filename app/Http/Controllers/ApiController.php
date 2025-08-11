<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function store(Request $request): void
    {
        $json = $request->json();

        echo $json->get('test');
    }
}

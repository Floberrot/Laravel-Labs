<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function Symfony\Component\Translation\t;

class ApiController extends Controller
{
    public function store(Request $request): void
    {
        $request->validate([
            'test' => 'required|string'
        ]);

        $json = $request->json();

        echo $json->get('test');
    }
}

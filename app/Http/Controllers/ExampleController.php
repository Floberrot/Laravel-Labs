<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ExampleController extends Controller
{
    public function get(): View
    {
        return view('example');
    }

    public function show(int $id): View
    {
        return view('example.show', ['id' => $id]);
    }
}

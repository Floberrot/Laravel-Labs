<?php

use App\Http\Controllers\ExampleController;
use App\Http\Middleware\LogMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/example', [ExampleController::class, 'get']);

Route::get('/example/{id}', [ExampleController::class, 'show'])
->name('example.show')
->where('id', '[0-9]+')
->middleware(LogMiddleware::class);

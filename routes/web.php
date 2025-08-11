<?php

use App\Http\Controllers\ExampleController;
use App\Http\Middleware\LogMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(ExampleController::class)->group(function () {
    Route::get('/example', 'get');
    Route::get('/example/{id}', 'show')
        ->name('example.show')
        ->where('id', '[0-9]+')
        ->middleware(LogMiddleware::class);
});


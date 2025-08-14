<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

//
//Route::controller(ApiController::class)->group(function () {
//    Route::post('test', 'store');
//});

Route::get('/ping', function () {
    return ['pong' => true];
});

Route::get('/health', function () {
    return 'ok';
})->name('health');

Route::get('/hello/{name}', function (string $name) {
    return ['response' => 'Hello ' . $name];
})->name('hello-name');

Route::get('/hello-opt/{name?}', function (?string $name = null) {
    $name ??= 'world';
    return ['response' => "Hello {$name}!"];
})->name('hello.opt');

Route::get('/users/{id}', function (int $id) {
    return ['id' =>$id];
})
    ->where('id', '[0-9]+')
    ->name('users.show');

Route::prefix('/v1')->name('v1.')->middleware('throttle:30,1')->group(function () {
    Route::name('status')->get('status', function (){
        return ['status' => 'ok'];
    });
    Route::name('version')->get('version', function (){
        return ['status' => 'v1'];
    });

});

Route::prefix('v1')
    ->name('v1.')
    ->middleware('throttle:30,1')
    ->group(function () {
        Route::get('status', fn() => ['status' => 'ok'])->name('status');
        Route::get('version', fn() => ['version' => '1.0'])->name('version');
        Route::fallback(fn() => response()->json('Error not found', 404));
    });

Route::redirect('/docs', '/api/documentation', 302);
Route::get('/documentation', fn () => ['doc' => 'ok']);
Route::redirect("old-home", "home", 301);

Route::controller(TestController::class)->prefix('tests')->name('tests.')->group(function () {
    Route::get('', 'index')->name('index');
    Route::get('/{id}', 'show')->whereNumber('id')->name('show');
});

Route::get('/profiles/{user}', function (string $user) {
    $users = ['florian', 'pierre', 'paul'];
    abort_unless(in_array($user, $users), 404);

    return ['profile' => $user];
});

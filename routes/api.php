<?php

use App\Enums\StatusEnum;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TestController;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Route;

Route::pattern('slug', '[a-z0-9-]+');

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
    return ['id' => $id];
})
    ->where('id', '[0-9]+')
    ->name('users.show');

Route::prefix('/v1')->name('v1.')->middleware('throttle:30,1')->group(function () {
    Route::name('status')->get('status', function () {
        return ['status' => 'ok'];
    });
    Route::name('version')->get('version', function () {
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
Route::get('/documentation', fn() => ['doc' => 'ok']);
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

Route::controller(ArticleController::class)
    ->name('articles.')
    ->prefix('articles')
    ->group(function () {
        Route::get('', 'index')
            ->name('index');
        Route::get('{slug}', 'show')
            ->name('show');
    });

Route::get('/status/{status}', function (StatusEnum $status) {
    return ['status' => $status->value];
});



Route::get('/files/link/{id}', function (int $id) {
    $url = URL::temporarySignedRoute('files.download', now()->addSeconds(300), ['id' => $id]);
    return ['link' => $url];
})->name('files.link');

Route::get('/files/{id}/download', function (int $id) {
    return ['download' => $id];
})->name('files.download')->middleware('signed');


RateLimiter::for('search', function (\Illuminate\Http\Request $request){
   return $request->user()
       ? Limit::perMinute(100)->by($request->user()->id)
       : Limit::perMinute(10)->by($request->ip());
});

Route::middleware('throttle:search')->group(function () {
    Route::post('/search', fn() => ['ok' => true]);
});


Route::get('/session/set/{value}', function (Request $request, string $value) {
    session()->put('my_key', $value);
    return ['message' => "Session set: {$value}"];
});

Route::get('/session/get', function (Request $request) {
    return ['value' => session()->get('my_key', 'not set')];
})->name('session.get');

Route::get('/session/flash/{value}', function (Request $request, string $value) {
    session()->flash('flash_key', $value);
    return ['message' => "Flash set: {$value}"];
});

Route::get('/session/flash-get', function (Request $request) {
    return ['flash' => session()->get('flash_key', 'none')];
});


Route::controller(ApiController::class)->prefix('v2')->name('api.v2.')->group(function () {
    Route::post('register', 'register');
});

Route::controller(PostController::class)->prefix('post')->name('post.')->group(function () {
   Route::post('', 'store')
        ->name('store');
});

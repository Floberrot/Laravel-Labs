<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('The user try to access this route : ' . $request->path());
        $explode = explode('/', $request->path());
        $id = end($explode);
        Log::info('Info route : ' . route('example.show', ['id' => $id]));
        return $next($request);
    }
}

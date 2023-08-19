<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;

class CheckRouteExists
{
    public function handle($request, Closure $next)
    {
        $route = Route::getRoutes()->match($request);

        if (!$route) {
            return redirect()->route('client_home'); // Sử dụng 'client_home' thay vì 'home'
        }

        return $next($request);
    }
}

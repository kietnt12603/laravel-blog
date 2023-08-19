<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CustomerMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->hasRole('customer')) {
            return $next($request);
        }

        return redirect('/');
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->hasRole('admin')) {
            return $next($request);
        }

        return redirect('/auth/login'); // Hoặc điều hướng đến trang khác nếu không có quyền
    }
}

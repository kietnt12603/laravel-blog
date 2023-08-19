<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role->name !== $role) {
            return abort(403, 'Bạn Không Có Quyền Truy Cập.');
            // return redirect()->route('login');
        }

        return $next($request);
    }
}

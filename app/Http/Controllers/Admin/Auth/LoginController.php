<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\role;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.page.auth.login');
    }
    public function store(Request $request)
    {
        // dd($request->input());
        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $request->input('remember'))) {
            $user = Auth::user();
            if ($user->hasRole('admin')) {
                return redirect()->route('admin_blog');
            } else if ($user->hasRole('editor')) {
                return redirect()->route('editor_blog');
            } else if ($user->hasRole('author')) {
                return redirect()->route('author_blog');
            } else {
                Auth::logout();
                Session::flash('messages', 'Bạn Không có quyền Truy Cập');
                return redirect()->back();
            }
        }
        Session::flash('messages', 'Email hoặc mật khẩu không đúng');
        return redirect()->back();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/auth/login');
    }
}

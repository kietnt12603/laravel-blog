<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth; // Đảm bảo bạn đã import
use Illuminate\Http\Request; // Đảm bảo bạn đã import
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::guard('customers')->check()) {
            return redirect()->route('client_home');
        }
        return view('client.page.login.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'email không được để trống',
            'email.email' => 'Email Không đúng định dạng',
            'password.required' => 'Mật Khẩu không được để trống',
        ]);
        if (Auth::guard('customers')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $request->input('remember'))) {
            $user = Auth::guard('customers')->user();
            return redirect()->intended('/');
        } else {
            Session::flash('messages', 'Tài Khoản Hoặc Mật Khẩu Không Đúng');
            return redirect()->back();
        }
    }
    public function logout(Request $request)
    {
        Auth::guard('customers')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function register()
    {
        if (Auth::guard('customers')->check()) {
            return redirect()->route('client_home');
        }
        return view('client.page.login.register');
    }
    public function register_(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed'],
        ], [
            'name.required' => 'Tên không được để trống',
            'password.required' => 'Mật Khẩu không được để trống',
            'password.confirmed' => 'Nhập Lại Mật Khẩu Không Khớp',
            'email.required' => 'email không được để trống',
            'email.email' => 'Email Không đúng định dạng',
            'email.unique' => 'Email Đã Tồn Tại'
        ]);
        $register = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role_id' => 4
        ]);
        Auth::guard('customers')->login($register);

        Session::flash('success', 'Đăng Ký Thành Công');
        return redirect('/');
    }
    public function forgotpassword()
    {
        return view('client.page.login.forgotpassword');
    }

    public function forgotpassword_store(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users'
        ], [
            'email.required' => 'Vui Lòng Nhập Email',
            'email.exists' => 'Email này Không Tồn Tại Trong Hệ Thông',
        ]);
        // Tạo một token ngẫu nhiên
        $token = strtoupper(Str::random(10));

        // Tìm người dùng theo email và role_id
        $customer = User::where('email', $request->email)->first();

        // Kiểm tra xem người dùng có tồn tại không
        if ($customer) {
            // Cập nhật token cho người dùng
            $customer->update(['token' => $token]);

            // Gửi email tới người dùng với token
            Mail::send('email.check_mail_forgot', compact('customer'), function ($email) use ($customer) {
                $email->subject('Quên Mật Khẩu');
                $email->to($customer->email, $customer->name);
            });
        }
        return redirect()->back()->with('success', 'Vui Lòng Kiểm Tra Địa Chỉ Email của bạn');
    }
    public function getPass($customer, $token)
    {
        $customer = User::find($customer);
        // dd($customer);
        if ($customer->token === $token) {
            return view('client.page.login.passwordReset');
        }
        return abort(404);
    }
    public function getPass_store($customer, $token, Request $request)
    {
        $customer = User::find($customer);
        $request->validate([
            'password' => 'required|confirmed'
        ], [
            'password.required' => 'Mật Khẩu không được để trống',
            'password.confirmed' => 'Nhập Lại Mật Khẩu Không Khớp',
        ]);
        $password = Hash::make($request->input('password'));
        $token = null;
        $customer->update(['password' => $password, 'token' => $token]);
        // dd($password, $token, $customer);
        return redirect()->route('client_login')->with('success', 'Đặt Lại Mật Khẩu Thành Công');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\Login;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Login $request)
    {
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);

        // sai tài khoản
        if (!$token) {
            $message = "Sai thông tin đăng nhập";
            toastr()->error($message, 'Thất bại');

            return back()->withErrors(['wrong-info' => $message]);
        }

        // tài khoản không có quyền truy cập
        if (count(Auth::user()->permissions) < 1) {
            $message = "Tài khoản không có quyền truy cập";
            toastr()->error($message, 'Thất bại');
            Auth::logout();

            return back()->withErrors(['wrong-info' => $message]);
        }

        toastr()->success('Đăng nhập thành công', 'Thành công');
        return redirect()->route('admin.homepage');
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();

            toastr()->success('Đăng xuất thành công', 'Thành công');
            return redirect()->route('login.form');
        }

        toastr()->error('Đăng xuất thất bại', 'Lỗi');
        return redirect()->route('admin.homepage');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FormController extends Controller
{
    public function login()
    {
        // Check if the user is already authenticated
        if (Auth::check()) {
            toastr()->error('Vui lòng đăng xuất trước!', 'Thất bại');
            return back();
        }

        $title = 'Đăng nhập';
        $pageViewInfo = 'admin.pages.auth.login';

        return view('admin.pages.auth.index', compact('title', 'pageViewInfo'));
    }

    public function forgotPassword()
    {
        // Check if the user is already authenticated
        if (Auth::check()) {
            toastr()->error('Vui lòng đăng xuất trước!', 'Thất bại');
            return back();
        }

        $title = 'Quên mật khẩu';
        $pageViewInfo = 'admin.pages.auth.forgot-password';

        return view('admin.pages.auth.index', compact('title', 'pageViewInfo'));
    }

    public function newPassword(string $token)
    {
        $title = 'Tạo mật khẩu mới';
        $pageViewInfo = 'admin.pages.auth.create-new-password';

        return view('admin.pages.auth.index', compact('title', 'pageViewInfo', 'token'));
    }
}

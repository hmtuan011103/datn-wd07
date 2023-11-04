<?php
namespace App\Http\Controllers\Auth\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required',
        ]);

        if (!Hash::check($request->oldPassword, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Mật khẩu cũ không đúng.'
            ]);
        }

        $user->update([
            'password' => Hash::make($request->newPassword)
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Mật khẩu đã được cập nhật.'
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users,email," . $user->id,
            "phone_number" => "required",
            "location" => "nullable"
        ]);

        $user->update([
            "name" => $request->name,
            "email" => $request->email,
            "phone_number" => $request->phone_number,
            "location" =>$request->location
        ]);

        return response()->json([
            "status" => true,
            "message" => "Profile updated successfully",
            "data" => $user
        ]);
    }
    public function register(Request $request){

        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|confirmed",
            "phone_number" => "required",
        ]);

        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "phone_number" => $request->phone_number,
            "user_type_id" => $request->user_type_id ?? 1,
        ]);

        // Response
        return response()->json([
            "status" => true,
            "message" => "User created successfully",
            "redirect_url" => route('auth')
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (password_verify($request->password, $user->password)) {
                $token = JWTAuth::fromUser($user);

                return response()->json([
                    "status" => true,
                    "message" => "User logged in successfully",
                    "token" => $token,
                    "redirect_url" => route('/')
                ]);
            } else {
                // Mật khẩu sai
                return response()->json([
                    "status" => false,
                    "message" => "Tên tài khoản hoặc mật khẩu không chính xác.",
                ]);
            }
        } else {
            // Tài khoản không tồn tại
            return response()->json([
                "status" => false,
                "message" => "Tài khoản không tồn tại",
            ]);
        }

        // Đoạn mã dưới đây thêm một thông báo lỗi khi cả tài khoản và mật khẩu đều sai
        return response()->json([
            "status" => false,
            "message" => "Tài khoản và mật khẩu không đúng",
        ]);
    }
     public function profile(){

        $userdata = auth()->user();

        return response()->json([
            "status" => true,
            "message" => "Profile data",
            "data" => $userdata
        ]);
    }


}

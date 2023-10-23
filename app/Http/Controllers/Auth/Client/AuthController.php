<?php

namespace App\Http\Controllers\Auth\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use function Laravel\Prompts\alert;

class AuthController extends Controller
{
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
                    "redirect_url" => route('search')
                ]);
            } else {
                return response()->json([
                    "status" => false,
                    "message" => "Mật khẩu bạn nhập vào không đúng",
                ]);
            }
        }

        return response()->json([
            "status" => false,
            "message" => "Tài khoản của bạn không đúng",
        ]);
    }


}

<?php
namespace App\Http\Controllers\Auth\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Bill;
use App\Models\DiscountCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function changePassword(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Người dùng không tồn tại.'
            ]);
        }

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
            "email" => [
                "required",
                "email",
                Rule::unique('users')->where(function ($query) {
                    return $query->where('user_type_id', 1);
                }),
            ],
            "password" => "required|confirmed",
            "phone_number" => "required",
        ]);

        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "phone_number" => $request->phone_number,
            "user_type_id" => 1,
        ]);

        return response()->json([
            "status" => true,
            "message" => "User created successfully",
            "redirect_url" => route('dang-nhap')
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        $user = User::where('email', $request->email)->where('user_type_id', 1)->first();

        if ($user) {
            if (password_verify($request->password, $user->password)) {
                $token = JWTAuth::fromUser($user);
                $request->session()->put('jwt_token', $token);
                return response()->json([
                    "status" => true,
                    "message" => "User logged in successfully",
                    "token" => $token,
                    "redirect_url" => route('trang_chu')
                ])->header('Authorization', 'Bearer ' . $token);
            } else {
                return response()->json([
                    "status" => false,
                    "message" => "Tài khoản hoặc mật khẩu không chính xác.",
                ]);
            }
        } else {
            // Tài khoản không tồn tại
            return response()->json([
                "status" => false,
                "message" => "Tài khoản hoặc mật khẩu không chính xác.",
            ]);
        }

        // Đoạn mã dưới đây thêm một thông báo lỗi khi cả tài khoản và mật khẩu đều sai
        return response()->json([
            "status" => false,
            "message" => "Tài khoản hoặc mật khẩu không chính xác.",
        ]);
    }
    public function profile(){
        // Lấy thông tin người dùng
        $userData = auth()->user();

        $totalSeats = DB::table('bills')
            ->where('user_id', $userData->id)
            ->sum('total_seats');

        $userData->total_seats = $totalSeats;

        return response()->json([
            "status" => true,
            "message" => "Profile data",
            "data" => $userData
        ]);
    }
    public function logout(Request $request){

        auth()->logout();
        $request->session()->forget('jwt_token');
        return response()->json([
            "status" => true,
            "message" => "User logged out successfully"
        ]);
    }

    public function discount()
    {
        $userData = auth()->user();

        $totalSeats = DB::table('bills')
            ->where('user_id', $userData->id)
            ->sum('total_seats');

        $usedDiscounts = DB::table('bills')
            ->where('user_id', $userData->id)
            ->whereNotNull('discount_code_id')
            ->pluck('discount_code_id');

        $allDiscounts = DiscountCode::all();

        // Chuyển đổi collection thành mảng
        $unusedDiscounts = $allDiscounts->reject(function ($discount) use ($usedDiscounts) {
            return in_array($discount->id, $usedDiscounts->toArray());
        })->toArray();

        $combinedData = [
            'total_seats' => $totalSeats,
            'discounts' => $unusedDiscounts,
        ];

        return response()->json([
            "status" => true,
            "message" => "List of discounts and total seats",
            "data" => $combinedData
        ]);
    }
    public function getAllPhone()
    {
        $usersWithPassword = DB::table('users')
            ->whereNotNull('password')
            ->where('user_type_id',1)
            ->pluck('phone_number');

        return response()->json([
            'status' => true,
            'phone_numbers' => $usersWithPassword,
        ]);
    }
    public function getBills()
    {
        $user = Auth::user();

        // Lấy danh sách hóa đơn và liên kết với bảng trips để lấy thông tin về chuyến xe
        $bills = Bill::where('user_id', $user->id)
            ->with(['trip' => function ($query) {
                $query->select('id', 'car_id', 'start_date', 'start_location', 'end_location', 'trip_price', 'interval_trip');
            }])
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Danh sách các hóa đơn của người dùng',
            'data' => $bills
        ]);
    }


}

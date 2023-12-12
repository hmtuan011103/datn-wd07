<?php
namespace App\Http\Controllers\Auth\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Jobs\SendDiscountEmail;
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
use Illuminate\Support\Facades\Mail;
use App\Mail\DiscountNotification;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;


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
        // Nếu chưa gửi và số ghế lớn hơn 1, gửi email và đặt trạng thái đã gửi

        if ($totalSeats >= 1 && $userData->email_sent_count === 0) {

            $discount = DiscountCode::where('code', 'CHIENTHANGVIP1')->first();
            $vip = 'VIP 1';
            SendDiscountEmail::dispatch($userData, $totalSeats,$discount,$vip);
            // Cập nhật cờ trạng thái đã gửi trong bảng người dùng
            $userData->increment('email_sent_count');
        }
        if ($totalSeats >= 10 && $userData->email_sent_count === 1) {
            $discount = DiscountCode::where('code', 'CHIENTHANGVIP2')->first();
            $vip = 'VIP 2';
            SendDiscountEmail::dispatch($userData, $totalSeats,$discount,$vip);
            // Cập nhật cờ trạng thái đã gửi trong bảng người dùng
            $userData->increment('email_sent_count');
        }
        if ($totalSeats >= 20 && $userData->email_sent_count === 2) {
            $discount = DiscountCode::where('code', 'CHIENTHANGVIP3')->first();
            $vip = 'VIP 3';
            SendDiscountEmail::dispatch($userData, $totalSeats,$discount,$vip);
            // Cập nhật cờ trạng thái đã gửi trong bảng người dùng
            $userData->increment('email_sent_count');
        }
        if ($totalSeats >= 30 && $userData->email_sent_count === 3) {
            $discount = DiscountCode::where('code', 'CHIENTHANGVIP4')->first();
            $vip = 'VIP 4';
            SendDiscountEmail::dispatch($userData, $totalSeats,$discount,$vip);
            // Cập nhật cờ trạng thái đã gửi trong bảng người dùng
            $userData->increment('email_sent_count');
        }

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
        try {
            $userData = auth()->user();
            $totalSeats = DB::table('bills')
                ->where('user_id', $userData->id)
                ->sum('total_seats');

            $usedDiscounts = DB::table('bills')
                ->where('user_id', $userData->id)
                ->whereNotNull('discount_code_id')
                ->pluck('discount_code_id');

            $currentDateTime = Carbon::now();

            $allDiscounts = DiscountCode::query()
                ->where('start_time', '<=', $currentDateTime)
                ->where('end_time', '>=', $currentDateTime)
                ->where('quantity', '>', 0)
                ->get();

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
        } catch (\Exception $e) {
            \Log::error('Error sending email: ' . $e->getMessage());
            return response()->json([
                "status" => false,
                "message" => "An error occurred but the process continued: " . $e->getMessage(),
                "data" => null
            ]);
        }
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

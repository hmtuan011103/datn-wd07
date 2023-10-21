<?php

use App\Http\Controllers\Locations\Admin\LocationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Client\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// soft delete multiple for type user
Route::delete('type_users/destroy-multiple', [\App\Http\Controllers\TypeUser\Admin\TypeUserController::class, 'destroyMultiple'])->name('api.type_users.destroy.multiple');
// soft delete multiple for user
Route::delete('users/destroy-multiple', [\App\Http\Controllers\User\Admin\UserController::class, 'destroyMultiple'])->name('api.users.destroy.multiple');

//login-Client
Route::post("register", [AuthController::class, 'register']);
Route::post("login", [AuthController::class, 'login']);

//Route::group([
//    "middleware" =>["auth:api"]
//],function (){
//    Route::get("profile",[ApiController::class,'profile']);
//    Route::get("refresh",[ApiController::class,'refreshToken']);
//    Route::get("logout",[ApiController::class,'logout']);
//
//});

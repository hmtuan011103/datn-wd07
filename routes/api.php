<?php

use App\Http\Controllers\Locations\Admin\LocationController;
use App\Http\Controllers\RedisWork\RedisController;
use App\Http\Controllers\User\Admin\UserController;
use App\Http\Controllers\DiscountCode\Client\DiscountCodeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Client\AuthController;
use App\Http\Controllers\Home\Admin\HomeController;
use App\Http\Controllers\Locations\Client\LocationController as ClientLocationController;
use App\Http\Controllers\Statistic\Admin\StatisticController;
use App\Http\Controllers\Ticket\Admin\TicketController as AdminTicketController;
use App\Http\Controllers\Ticket\Client\TicketController;
use App\Http\Controllers\Trip\Admin\TripController as AdminTripController;
use App\Http\Controllers\Trip\Client\TripController;

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

// soft delete multiple for type user
Route::delete('type_users/destroy-multiple', [\App\Http\Controllers\TypeUser\Admin\TypeUserController::class, 'destroyMultiple'])->name('api.type_users.destroy.multiple');
// soft delete multiple for user
Route::delete('users/destroy-multiple', [\App\Http\Controllers\User\Admin\UserController::class, 'destroyMultiple'])->name('api.users.destroy.multiple');

//login-Client
Route::post("register", [AuthController::class, 'register']);
Route::post("login", [AuthController::class, 'login']);
Route::group([
    "middleware" => ["auth:api"]
], function(){

    Route::get("profile", [AuthController::class, "profile"]);
    Route::get("refresh", [AuthController::class, "refreshToken"]);
    Route::get('discounts', [AuthController::class, 'discount']);
    Route::get('getBills', [AuthController::class, 'getBills']);
    Route::post("logout", [AuthController::class, "logout"]);
    Route::post('update_profile',  [AuthController::class, 'updateProfile']);
    Route::post('password', [AuthController::class, 'changePassword']);
});
Route::get('/data_user', [UserController::class, 'getData'])->name('getDataUser');
Route::get('/data_user_assistant', [UserController::class, 'getDataAssistant'])->name('getDataUserAssistant');

Route::get('getAllPhone', [AuthController::class, 'getAllPhone']);
Route::get('/data', [TripController::class, 'getData'])->name('getData');
Route::get('/search_trip', [TripController::class, 'search_start_trip'])->name('search_start_trip');

Route::get('/location/list_client_location',[ClientLocationController::class, 'list_client_location'])->name('api.location.list');
Route::get('/location/list_filter_location',[LocationController::class, 'list_filter_location']);
Route::get('searchtrip',[TripController::class, 'searchtrip'])->name('search_trip');

Route::get('searchtrip/get_type_car',[TripController::class, 'get_type_car'])->name('get_type_car');
Route::get('information-detail-trip', [TripController::class, 'getInformationDetailTrip']);
Route::get('trip/popular', [TripController::class, 'getPopularTripList']);
Route::get('get_seat_empty', [TripController::class, 'get_seat_empty'])->name('get_seat_empty');
Route::get('get_data_year', [HomeController::class, 'get_data_year'])->name('get_data_year');

Route::get('/search_ticket', [TicketController::class, 'search_ticket'])->name('search_ticket');
Route::get('/test-data', [\App\Http\Controllers\Checkout\CheckoutController::class, 'getTicketForBill']);

Route::get('news/recent', [TripController::class, 'getRecentNews']);


Route::delete('news/destroy-multiple', [\App\Http\Controllers\New\Admin\NewController::class, 'destroyMultiple']);

Route::get('permission/delete/{id}', [App\Http\Controllers\Permissions\Admin\PermissionController::class, 'delete']);

Route::get('/search_bill_admin', [AdminTicketController::class, 'search_bill_admin'])->name('search_bill_admin');

Route::get('/search_ticket_admin', [AdminTicketController::class, 'search_ticket_admin'])->name('search_ticket_admin');

Route::get('get-discount-ticket/{code}', [DiscountCodeController::class, 'getCodeUser'])->name('get-discount-ticket');

// Api test email when checkout successful
//Route::get('/test-mail', [AdminTicketController::class, 'testMail']);
Route::get('/get-data-from-redis', [RedisController::class, 'getDataFromRedis'])->name('get-data-from-redis');

Route::get('/filter', [TripController::class, 'getDataFilter'])->name('getDataFilter');


Route::post('/getCarDriver', [AdminTripController::class, 'getCarDriver'])->name('getCarDriver');

Route::post('/get_available_drivers', [AdminTripController::class, 'get_available_drivers'])->name('get_available_drivers');

Route::post('/getFilter', [StatisticController::class, 'getRevenue'])->name('getRevenue');

Route::get('/getRevenueData', [StatisticController::class, 'getRevenueData'])->name('getRevenueData');

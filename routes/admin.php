<?php

use App\Http\Controllers\Banner\Admin\BannerController;
use App\Http\Controllers\Locations\Admin\LocationController;
use App\Http\Controllers\Order\Admin\OrderController;
use App\Http\Controllers\OrderTicket\Admin\OrderTicketController;
use App\Http\Controllers\Role\Admin\RoleController;
use App\Http\Controllers\Permissions\Admin\PermissionController;
use App\Http\Controllers\UserRoles\Admin\UserRoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypeCar\Admin\TypeCarController;
use App\Http\Controllers\Car\Admin\CarController;
use App\Http\Controllers\DiscountCode\Admin\DiscountCodeController;
use App\Http\Controllers\Home\Admin\HomeController;
use App\Http\Controllers\Route\Admin\RouteController;
use App\Http\Controllers\Ticket\Admin\TicketController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Trip\Admin\TripController;
use App\Models\DiscountCode;

/*
|--------------------------------------------------------------------------
| Admin Routes ( With default prefix admin and url is: http://127.0.0.1:8000/manage + route )
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('admin.homepage');

Route::prefix('location')->group(function () {
    Route::get('/', [LocationController::class, 'list_location'])->name('list_location')->middleware('check_permission:read-location');
    Route::get('add', [LocationController::class, 'form_create'])->name('form_create')->middleware('check_permission:create-location');
    Route::post('store', [LocationController::class, 'create_location'])->name('create_location')->middleware('check_permission:create-location');
    Route::get('edit/{id}', [LocationController::class, 'edit_location'])->name('edit_location')->middleware('check_permission:update-location');
    Route::post('update/{id}', [LocationController::class, 'save_edit_location'])->name('save_edit_location')->middleware('check_permission:update-location');
    Route::get('delete/{id}', [LocationController::class, 'delete_location'])->name('delete_location')->middleware('check_permission:delete-location');
});

Route::prefix('trip')->group(function () {
    Route::get('/', [TripController::class, 'list_trip'])->name('list_trip')->middleware('check_permission:read-trip');
    Route::get('add', [TripController::class, 'form_create_trip'])->name('form_create_trip')->middleware('check_permission:create-trip');
    Route::post('store', [TripController::class, 'create_trip'])->name('create_trip')->middleware('check_permission:create-trip');
    Route::get('edit/{id}', [TripController::class, 'edit_trip'])->name('edit_trip')->middleware('check_permission:update-trip');
    Route::post('update/{id}', [TripController::class, 'save_edit_trip'])->name('save_edit_trip')->middleware('check_permission:update-trip');
    Route::get('delete/{id}', [TripController::class, 'delete_trip'])->name('delete_trip')->middleware('check_permission:delete-trip');
    Route::get('show/{id}', [TripController::class, 'show'])->name('show')->middleware('check_permission:read-trip');
    Route::post('import-trip',[TripController::class,'import_trip'])->name('import-trip');
});
Route::prefix('permission')->group(function () {
    Route::get('/', [PermissionController::class, 'index'])->name('list_permission')->middleware('check_permission:read-permission');
    Route::get('add', [PermissionController::class, 'add'])->name('add_permission')->middleware('check_permission:create-permission');
    Route::post('save_add', [PermissionController::class, 'store'])->name('store_permission')->middleware('check_permission:create-permission');
    Route::get('edit/{id}', [PermissionController::class, 'edit'])->name('edit_permission')->middleware('check_permission:update-permission');
    Route::post('save_edit/{id}', [PermissionController::class, 'update'])->name('update_permission')->middleware('check_permission:update-permission');
    Route::get('delete/{id}', [PermissionController::class, 'delete'])->name('delete_permission')->middleware('check_permission:delete-permission');
});
Route::prefix('user_role')->group(function () {
    Route::get('/', [UserRoleController::class, 'index'])->name('list_user')->middleware('check_permission:read-user-role');
});
Route::group(['prefix' => 'role'], function () {
    Route::get('/list_role', [RoleController::class, 'list'])->name('list_role')->middleware('check_permission:read-role');
    Route::get('/add_role', [RoleController::class, 'add'])->name('add_role')->middleware('check_permission:create-role');
    Route::post('/post_add_role', [RoleController::class, 'store'])->name('post_add_role')->middleware('check_permission:create-role');
    Route::get('/edit_role/{id}', [RoleController::class, 'edit'])->name('edit_role')->middleware('check_permission:update-role');
    Route::post('/post_edit_role/{id}', [RoleController::class, 'update'])->name('update_role')->middleware('check_permission:update-role');
    Route::get('/delete_role/{id}', [RoleController::class, 'delete'])->name('delete_role')->middleware('check_permission:delete-role');
});
Route::prefix('typecar')->group(function () {
    Route::get('/', [TypeCarController::class, 'index'])->name('index_typecar')->middleware('check_permission:read-car-type');
    Route::get('/create', [TypeCarController::class, 'create'])->name('create_typecar')->middleware('check_permission:create-car-type');
    Route::post('/store', [TypeCarController::class, 'store'])->name('store_typecar')->middleware('check_permission:create-car-type');
    Route::get('/edit/{id}', [TypeCarController::class, 'edit'])->name('edit_typecar')->middleware('check_permission:update-car-type');
    Route::put('/update/{id}', [TypeCarController::class, 'update'])->name('update_typecar')->middleware('check_permission:update-car-type');
    Route::get('/destroy/{id}', [TypeCarController::class, 'destroy'])->name('destroy_typecar')->middleware('check_permission:delete-car-type');
    Route::get('/destroy_all/{id}', [TypeCarController::class, 'destroy_all'])->name('destroy_typecar_all')->middleware('check_permission:delete-car-type');
});

Route::prefix('car')->group(function () {
    Route::get('/', [CarController::class, 'index'])->name('index_car')->middleware('check_permission:read-car');
    Route::get('/create', [CarController::class, 'create'])->name('create_car')->middleware('check_permission:create-car');
    Route::post('/store', [CarController::class, 'store'])->name('store_car')->middleware('check_permission:create-car');
    Route::get('/edit/{id}', [CarController::class, 'edit'])->name('edit_car')->middleware('check_permission:update-car');
    Route::put('/update/{id}', [CarController::class, 'update'])->name('update_car')->middleware('check_permission:update-car');
    Route::get('/destroy/{id}', [CarController::class, 'destroy'])->name('destroy_car')->middleware('check_permission:delete-car');
    Route::get('/destroy_all/{id}', [CarController::class, 'destroy_all'])->name('destroy_car_all')->middleware('check_permission:delete-car');
});

Route::group(['prefix' => 'role_permission'], function () {
    Route::get('/list_role_permission', [RoleController::class, 'index'])->name('list_role_permission');
    Route::get('/api/details/{id}', [RoleController::class, 'details'])->name('role_permission_details');
    Route::get('/api/get_permission', [RoleController::class, 'getPermission'])->name('get_permission_api');
});

Route::resource('type_cars', \App\Http\Controllers\TypeCar\Admin\TypeCarController::class)->middleware('check_permission:create-car-type,read-car-type,update-car-type,delete-car-type');

Route::name('users.')->prefix('users')->group(function () {
    Route::get('/', [\App\Http\Controllers\User\Admin\UserController::class, 'index'])->name('index')->middleware('check_permission:read-user');
    Route::get('create', [\App\Http\Controllers\User\Admin\UserController::class, 'create'])->name('create')->middleware('check_permission:create-user');
    Route::post('/', [\App\Http\Controllers\User\Admin\UserController::class, 'store'])->name('store')->middleware('check_permission:create-user');
    Route::get('{user}/edit', [\App\Http\Controllers\User\Admin\UserController::class, 'edit'])->name('edit')->middleware('check_permission:update-user');
    Route::match(['put', 'patch'], '{user}', [\App\Http\Controllers\User\Admin\UserController::class, 'update'])->name('update')->middleware('check_permission:update-user');
    Route::delete('{user}', [\App\Http\Controllers\User\Admin\UserController::class, 'destroy'])->name('destroy')->middleware('check_permission:delete-user');
    Route::get('{user}', [\App\Http\Controllers\User\Admin\UserController::class, 'show'])->name('show')->middleware('check_permission:read-user');
    Route::get('{user}/profile', [\App\Http\Controllers\User\Admin\UserController::class, 'profile'])->name('profile')->middleware('auth');
    Route::patch('{user}/profile/change-password', [\App\Http\Controllers\User\Admin\UserController::class, 'profileChangePassword'])->name('profile.change.password')->middleware('auth');
});

Route::name('type_users.')->prefix('type_users')->group(function () {
    Route::get('/', [\App\Http\Controllers\TypeUser\Admin\TypeUserController::class, 'index'])->name('index')->middleware('check_permission:read-user-type');
    Route::get('create', [\App\Http\Controllers\TypeUser\Admin\TypeUserController::class, 'create'])->name('create')->middleware('check_permission:create-user-type');
    Route::post('/', [\App\Http\Controllers\TypeUser\Admin\TypeUserController::class, 'store'])->name('store')->middleware('check_permission:create-user-type');
    Route::get('{type_user}/edit', [\App\Http\Controllers\TypeUser\Admin\TypeUserController::class, 'edit'])->name('edit')->middleware('check_permission:update-user-type');
    Route::match(['put', 'patch'], '{type_user}', [\App\Http\Controllers\TypeUser\Admin\TypeUserController::class, 'update'])->name('update')->middleware('check_permission:update-user-type');
    Route::delete('{type_user}', [\App\Http\Controllers\TypeUser\Admin\TypeUserController::class, 'destroy'])->name('destroy')->middleware('check_permission:delete-user-type');
});
Route::prefix('news')->group(function () {
    Route::get('/', [\App\Http\Controllers\New\Admin\NewController::class, 'index'])->name('index_new');
    Route::get('/create', [\App\Http\Controllers\New\Admin\NewController::class, 'create'])->name('create_new');
    Route::post('/store', [\App\Http\Controllers\New\Admin\NewController::class, 'store'])->name('store_new');
    Route::get('/edit/{id}', [\App\Http\Controllers\New\Admin\NewController::class, 'edit'])->name('edit_new');
    Route::put('/update/{id}', [\App\Http\Controllers\New\Admin\NewController::class, 'update'])->name('update_new');
    Route::delete(
        '/destroy/{id}',
        [\App\Http\Controllers\New\Admin\NewController::class, 'destroy']
    )->name('destroy_new');
});

Route::group(['prefix' => 'discount_code'], function () {
    Route::get('/', [DiscountCodeController::class, 'index'])->name('list_discount_code')->middleware('check_permission:read-discount-code');
    Route::get('/create', [DiscountCodeController::class, 'add'])->name('create_discount_code')->middleware('check_permission:create-discount-code');
    Route::post('/post_create', [DiscountCodeController::class, 'store'])->name('post_create_discount_code')->middleware('check_permission:create-discount-code');
    Route::get('/edit/{id}', [DiscountCodeController::class, 'edit'])->name('edit_discount_code')->middleware('check_permission:update-discount-code');
    Route::post('/post_edit/{id}', [DiscountCodeController::class, 'update'])->name('post_edit_discount_code')->middleware('check_permission:update-discount-code');
    Route::get('/delete/{id}', [DiscountCodeController::class, 'delete'])->name('delete_discount_code')->middleware('check_permission:delete-discount-code');
});

Route::group(['prefix' => 'order'], function () {
    Route::get('/', [OrderController::class, 'index'])->name('list_order')->middleware('check_permission:read-bill');
    Route::get('details/{id}', [OrderController::class, 'details'])->name('details_order');
    Route::get('export/{id}', [OrderController::class, 'export'])->name('export_order');
});
Route::group(['prefix' => 'order-ticket'], function () {
    Route::get('/', [OrderTicketController::class, 'index'])->name('order_ticket-admin')->middleware('check_permission:order-ticket-admin');
    Route::get('/search', [OrderTicketController::class, 'searchRouteAdmin'])->name('search_ticket-admin')->middleware('check_permission:order-ticket-admin');
    Route::get('/select-seat', [OrderTicketController::class, 'selectSeatAdmin'])->name('select_seat-admin')->middleware('check_permission:order-ticket-admin');
    Route::post('/detail-select-seat', [OrderTicketController::class, 'detailSelectSeatAdmin'])->name('detail_select_seat-admin')->middleware('check_permission:order-ticket-admin');
});

// authen
Route::get('login', [\App\Http\Controllers\Auth\FormController::class, 'login'])->name('login.form')->middleware('guest');
Route::prefix('auth')->group(function () {
    Route::post('login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login.submit')->middleware('guest');
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout.submit');
});
// reset password
Route::middleware(['guest'])->group(function () {
    Route::get('forgot-password', [\App\Http\Controllers\Auth\FormController::class, 'forgotPassword'])->name('forgot.password.form');
    Route::post('forgot-password', [\App\Http\Controllers\Auth\SubmitController::class, 'forgotPasswordSubmit'])->name('forgot.password.submit');
    Route::get('new-password/{token}', [\App\Http\Controllers\Auth\FormController::class, 'newPassword'])->name('password.reset');
    Route::post('new-password', [\App\Http\Controllers\Auth\SubmitController::class, 'newPasswordSubmit'])->name('password.update');
});

//search ticket
Route::get('/export-lichtrinh', [TripController::class,'export'])->name('export_trip')->middleware('check_permission:read-schedule');
Route::prefix('search-bill')->group(function () {
    Route::get('/', [TicketController::class, 'form_search_bill'])->name('form_search_bill')->middleware('check_permission:read-search-bill');
});
Route::prefix('search-ticket')->group(function () {
    Route::get('/', [TicketController::class, 'form_search_ticket'])->name('form_search_ticket')->middleware('check_permission:read-search-bill');
});

Route::middleware('check_permission:read-statistic')->name('statistics.')->prefix('statistics_general')->group(function () {
    Route::get('/', [\App\Http\Controllers\Statistic\Admin\StatisticController::class, 'index'])->name('car');
    Route::get('/user', [\App\Http\Controllers\Statistic\Admin\StatisticController::class, 'user'])->name('user');
    // Route::get('/user-data', 'YourController@getUserData')->name('user.data');
    Route::get('/revenue', [\App\Http\Controllers\Statistic\Admin\StatisticController::class, 'revenue'])->name('revenue');

});

Route::prefix('banner')->group(function () {
    Route::get('/', [BannerController::class, 'index'])->name('banner')->middleware('check_permission:read-banner');
    Route::get('create', [BannerController::class, 'create'])->name('create_banner')->middleware('check_permission:create-banner');
    Route::post('store', [BannerController::class, 'store'])->name('store_banner')->middleware('check_permission:create-banner');
    Route::get('edit/{id}', [BannerController::class, 'edit'])->name('edit_banner')->middleware('check_permission:update-banner');
    Route::post('update/{id}', [BannerController::class, 'update'])->name('update_banner')->middleware('check_permission:update-banner');
    Route::get('delete/{id}', [BannerController::class, 'delete'])->name('delete_banner')->middleware('check_permission:delete-banner');
    Route::post('update-status-banner/{id}', [BannerController::class, 'update_status'])->name('update_status_banner')->middleware('check_permission:update-banner');
});
Route::prefix('schedule')->group(function () {
    Route::get('/', [TripController::class, 'schedule'])->name('schedule')->middleware('check_permission:read-schedule');
});
Route::prefix('route')->group(function () {
    Route::get('/', [RouteController::class, 'index'])->name('list_route');
    Route::get('create', [RouteController::class, 'create'])->name('create_route');
    Route::post('post', [RouteController::class, 'store'])->name('store_route');
    Route::get('edit/{id}', [RouteController::class, 'edit'])->name('edit_route');
    Route::post('update/{id}', [RouteController::class, 'update'])->name('update_route');
    Route::get('delete/{id}', [RouteController::class, 'delete'])->name('delete_route');
    Route::get('details/{id}', [RouteController::class, 'details'])->name('details_route');
});
// đặt cuối route
Route::fallback(function () {
    abort(500);
});

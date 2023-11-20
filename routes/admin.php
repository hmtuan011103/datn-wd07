<?php

use App\Http\Controllers\Banner\Admin\BannerController;
use App\Http\Controllers\Locations\Admin\LocationController;
use App\Http\Controllers\Role\Admin\RoleController;
use App\Http\Controllers\Permissions\Admin\PermissionController;
use App\Http\Controllers\UserRoles\Admin\UserRoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypeCar\Admin\TypeCarController;
use App\Http\Controllers\Car\Admin\CarController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Trip\Admin\TripController;

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

Route::get('/', function () {
    if (!Auth::check() || count(Auth::user()->permissions) < 1) {
        toastr()->info('Vui lòng đăng nhập', 'Nhắc nhở');
        return redirect()->route('login.form');
    }

    return view('admin.pages.home.index', [
        'title' => 'Quản trị chiến thắng'
    ]);
})->name('admin.homepage');

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
    Route::delete('/destroy/{id}', [TypeCarController::class, 'destroy'])->name('destroy_typecar')->middleware('check_permission:delete-car-type');
});

Route::prefix('car')->group(function () {
    Route::get('/', [CarController::class, 'index'])->name('index_car')->middleware('check_permission:read-car');
    Route::get('/create', [CarController::class, 'create'])->name('create_car')->middleware('check_permission:create-car');
    Route::post('/store', [CarController::class, 'store'])->name('store_car')->middleware('check_permission:create-car');
    Route::get('/edit/{id}', [CarController::class, 'edit'])->name('edit_car')->middleware('check_permission:update-car');
    Route::put('/update/{id}', [CarController::class, 'update'])->name('update_car')->middleware('check_permission:update-car');
    Route::delete('/destroy/{id}', [CarController::class, 'destroy'])->name('destroy_car')->middleware('check_permission:delete-car');
});

Route::group(['prefix' => 'role_permission'], function () {
    Route::get('/list_role_permission', [RoleController::class, 'index'])->name('list_role_permission')->middleware('check_permission:create-user,read-user,update-user,delete-user');
    Route::get('/api/details/{id}', [RoleController::class, 'details'])->name('role_permission_details')->middleware('check_permission:create-user,read-user,update-user,delete-user');
    Route::get('/api/get_permission/{id}', [RoleController::class, 'getPermission'])->name('get_permission_api')->middleware('check_permission:create-user,read-user,update-user,delete-user');
});
Route::prefix('news')->group(function () {
    Route::get('/', [\App\Http\Controllers\New\Admin\NewController::class, 'index'])->name('index_new');
    Route::get('/create', [\App\Http\Controllers\New\Admin\NewController::class, 'create'])->name('create_new');
    Route::post('/store', [\App\Http\Controllers\New\Admin\NewController::class, 'store'])->name('store_new');
    Route::get('/edit/{id}', [\App\Http\Controllers\New\Admin\NewController::class, 'edit'])->name('edit_new');
    Route::put('/update/{id}', [\App\Http\Controllers\New\Admin\NewController::class, 'update'])->name('update_new');
    Route::delete('/destroy/{id}', [\App\Http\Controllers\New\Admin\NewController::class, 'destroy'])->name('destroy_new');
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
});

Route::name('type_users.')->prefix('type_users')->group(function () {
    Route::get('/', [\App\Http\Controllers\TypeUser\Admin\TypeUserController::class, 'index'])->name('index')->middleware('check_permission:read-user-type');
    Route::get('create', [\App\Http\Controllers\TypeUser\Admin\TypeUserController::class, 'create'])->name('create')->middleware('check_permission:create-user-type');
    Route::post('/', [\App\Http\Controllers\TypeUser\Admin\TypeUserController::class, 'store'])->name('store')->middleware('check_permission:create-user-type');
    Route::get('{type_user}/edit', [\App\Http\Controllers\TypeUser\Admin\TypeUserController::class, 'edit'])->name('edit')->middleware('check_permission:update-user-type');
    Route::match(['put', 'patch'], '{type_user}', [\App\Http\Controllers\TypeUser\Admin\TypeUserController::class, 'update'])->name('update')->middleware('check_permission:update-user-type');
    Route::delete('{type_user}', [\App\Http\Controllers\TypeUser\Admin\TypeUserController::class, 'destroy'])->name('destroy')->middleware('check_permission:delete-user-type');
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

Route::prefix('banners')->controller(BannerController::class)->group(function () {
    Route::get('/', 'index')->name('banner.index');
    Route::match(['GET', 'POST'], 'create', 'store')->name('banner.store');
    Route::match(['GET', 'PATCH'], 'update/{banner}', 'update')->name('banner.update');
});



// đặt cuối route
Route::fallback(function () {
    abort(500);
});

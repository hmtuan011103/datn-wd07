<?php

use App\Http\Controllers\Locations\Admin\LocationController;
use App\Http\Controllers\Locations\Admin\Role_permission;
use App\Http\Controllers\Role\Admin\RoleController;
use App\Http\Controllers\Permissions\Admin\PermissionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypeCar\Admin\TypeCarController;
use App\Http\Controllers\Car\Admin\CarController;

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
    return view('admin.pages.home.index', [
        'title' => 'Quản trị chiến thắng'
    ]);
});
Route::prefix('permission')->group(function () {
    Route::get('/', [PermissionController::class, 'index'])->name('list_permission');
    Route::get('add',[PermissionController::class,'add'])->name('add_permission');
    Route::post('save_add',[PermissionController::class,'store'])->name('store_permission');
    Route::get('edit/{id}',[PermissionController::class,'edit'])->name('edit_permission');
    Route::post('save_edit/{id}',[PermissionController::class,'update'])->name('update_permission');
    Route::get('delete/{id}',[PermissionController::class,'delete'])->name('delete_permission');
});
Route::prefix('user_role')->group(function () {
    Route::get('/', [UserRoleController::class, 'index'])->name('list_user');
});
Route::group(['prefix' => 'role'], function () {
    Route::get('/list_role', [RoleController::class, 'list'])->name('list_role');
    Route::get('/add_role', [RoleController::class, 'add'])->name('add_role');
    Route::post('/post_add_role', [RoleController::class, 'store'])->name('post_add_role');
    Route::get('/edit_role/{id}', [RoleController::class, 'edit'])->name('edit_role');
    Route::post('/post_edit_role/{id}', [RoleController::class, 'update'])->name('update_role');
    Route::get('/delete_role/{id}', [RoleController::class, 'delete'])->name('delete_role');
});
Route::prefix('typecar')->group(function () {
    Route::get('/', [TypeCarController::class, 'index'])->name('index_typecar');
    Route::get('/create', [TypeCarController::class, 'create'])->name('create_typecar');;
    Route::post('/store', [TypeCarController::class, 'store'])->name('store_typecar');
    Route::get('/edit/{id}',[TypeCarController::class,'edit'])->name('edit_typecar');
    Route::put('/update/{id}', [TypeCarController::class, 'update'])->name('update_typecar');
    Route::delete('/destroy/{id}', [TypeCarController::class, 'destroy'])->name('destroy_typecar');
});

Route::prefix('car')->group(function () {
    Route::get('/', [CarController::class, 'index'])->name('index_car');
    Route::get('/create', [CarController::class, 'create'])->name('create_car');
    Route::post('/store', [CarController::class, 'store'])->name('store_car');
    Route::get('/edit/{id}',[CarController::class,'edit'])->name('edit_car');
    Route::put('/update/{id}', [CarController::class, 'update'])->name('update_car');
    Route::delete('/destroy/{id}', [CarController::class, 'destroy'])->name('destroy_car');
});

Route::group(['prefix' => 'role_permission'], function () {
    Route::get('/list_role_permission', [RoleController::class, 'index'])->name('list_role_permission');
    Route::get('/api/details/{id}', [RoleController::class, 'details'])->name('role_permission_details');
    Route::get('/api/get_permission/{id}', [RoleController::class, 'getPermission'])->name('get_permission_api');
});

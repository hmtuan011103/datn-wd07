<?php

use App\Http\Controllers\Locations\Admin\LocationController;
use App\Http\Controllers\Locations\Admin\Role_permission;
use App\Http\Controllers\Locations\Admin\RoleController;
use App\Http\Controllers\Permissions\Admin\PermissionController;
use App\Http\Controllers\UserRoles\Admin\UserRoleController;
use Illuminate\Support\Facades\Route;

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
    // Route::get('add',[PermissionController::class,'add'])->name('add');
    // Route::post('save_add',[PermissionController::class,'save_add'])->name('addPermission');
    // Route::get('edit/{id}',[PermissionController::class,'edit'])->name('editPermission');
    // Route::post('save_edit/{id}',[PermissionController::class,'save_edit'])->name('saveEditPermission');
    // Route::get('delete/{id}',[PermissionController::class,'delete'])->name('deletePermission');
});
Route::group(['prefix' => 'role'], function () {
    Route::get('/list_role', [RoleController::class, 'list'])->name('list_role');
    Route::match(['GET','POST'],'/add_role', [RoleController::class, 'add'])->name('add_role');
    Route::match(['GET','POST'],'/edit_role/{id}', [RoleController::class, 'edit'])->name('edit_role');
    Route::get('/delete_role/{id}', [RoleController::class, 'delete'])->name('delete_role');
    // Route::get('/details/{id}', 'NotificationController@notification_details');
});

Route::group(['prefix' => 'role_permission'], function () {
    // Route::get('/list', [RoleController::class, 'list'])->name('list_role');
    Route::match(['GET','POST'],'/add_role_permission', [Role_permission::class, 'add'])->name('add_role_permission');
    // Route::match(['GET','POST'],'/edit/{id}', [RoleController::class, 'edit'])->name('edit_role');
    // Route::get('/delete/{id}', [RoleController::class, 'delete'])->name('delete_role');
    // // Route::get('/details/{id}', 'NotificationController@notification_details');
});

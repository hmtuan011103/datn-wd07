<?php

use App\Http\Controllers\Locations\Admin\LocationController;
use App\Http\Controllers\Locations\Admin\Role_permission;
use App\Http\Controllers\Locations\Admin\RoleController;
use App\Http\Controllers\PermissionController;
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
    Route::get('/', [PermissionController::class, 'list'])->name('listPermission');
    Route::post('save_permissions', [PermissionController::class, 'add'])->name('addPermission');
    Route::get('edit/{id}', [PermissionController::class, 'edit'])->name('editPermission');
    Route::post('save_edit/{id}', [PermissionController::class, 'save_edit'])->name('saveEditPermission');
    Route::get('delete/{id}', [PermissionController::class, 'delete'])->name('deletePermission');
});

Route::group(['prefix' => 'role'], function () {
    Route::get('/list_role', [RoleController::class, 'list'])->name('list_role');
    Route::match(['GET', 'POST'], '/add_role', [RoleController::class, 'add'])->name('add_role');
    Route::match(['GET', 'POST'], '/edit_role/{id}', [RoleController::class, 'edit'])->name('edit_role');
    Route::get('/delete_role/{id}', [RoleController::class, 'delete'])->name('delete_role');
    // Route::get('/details/{id}', 'NotificationController@notification_details');
});

Route::group(['prefix' => 'role_permission'], function () {
    // Route::get('/list', [RoleController::class, 'list'])->name('list_role');
    Route::match(['GET', 'POST'], '/add_role_permission', [Role_permission::class, 'add'])->name('add_role_permission');
    // Route::match(['GET','POST'],'/edit/{id}', [RoleController::class, 'edit'])->name('edit_role');
    // Route::get('/delete/{id}', [RoleController::class, 'delete'])->name('delete_role');
    // // Route::get('/details/{id}', 'NotificationController@notification_details');
});

Route::resource('users', \App\Http\Controllers\User\Admin\UserController::class);
Route::resource('type_users', \App\Http\Controllers\TypeUser\Admin\TypeUserController::class)->except('show');

<?php

use App\Http\Controllers\Locations\Admin\LocationController;
use App\Http\Controllers\Locations\Admin\Role_permission;
use App\Http\Controllers\Role\Admin\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RolePermission\Admin\RolePermissionController;
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
    Route::post('save_permissions',[PermissionController::class,'add'])->name('addPermission');
    Route::get('edit/{id}',[PermissionController::class,'edit'])->name('editPermission');
    Route::post('save_edit/{id}',[PermissionController::class,'save_edit'])->name('saveEditPermission');
    Route::get('delete/{id}',[PermissionController::class,'delete'])->name('deletePermission');
});

Route::group(['prefix' => 'role'], function () {
    Route::get('/list_role', [RoleController::class, 'list'])->name('list_role');
    Route::get('/add_role', [RoleController::class, 'add'])->name('add_role');
    Route::post('/post_add_role', [RoleController::class, 'store'])->name('post_add_role');
    Route::get('/edit_role/{id}', [RoleController::class, 'edit'])->name('edit_role');
    Route::post('/post_edit_role/{id}', [RoleController::class, 'update'])->name('update_role');
    Route::get('/delete_role/{id}', [RoleController::class, 'delete'])->name('delete_role');
});

Route::group(['prefix' => 'role_permission'], function () {
    Route::get('/list_role_permission', [RoleController::class, 'index'])->name('list_role_permission');
    Route::get('/api/details/{id}', [RoleController::class, 'details'])->name('role_permission_details');
    Route::get('/api/get_permission/{id}', [RoleController::class, 'getPermission'])->name('get_permission_api');
});

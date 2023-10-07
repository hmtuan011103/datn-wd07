<?php

use App\Http\Controllers\Locations\Admin\LocationController;
use App\Http\Controllers\Locations\Admin\Role_permission;
use App\Http\Controllers\Locations\Admin\RoleController;
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
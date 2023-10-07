<?php

use App\Http\Controllers\Locations\Admin\LocationController;
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
    Route::post('save_permissions',[PermissionController::class,'add'])->name('addPermission');
    Route::get('edit/{id}',[PermissionController::class,'edit'])->name('editPermission');
    Route::post('save_edit/{id}',[PermissionController::class,'save_edit'])->name('saveEditPermission');
    Route::get('delete/{id}',[PermissionController::class,'delete'])->name('deletePermission');
});


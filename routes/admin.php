<?php

use App\Http\Controllers\Locations\Admin\LocationController;
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


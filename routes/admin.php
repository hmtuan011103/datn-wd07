<?php

use App\Http\Controllers\Locations\Admin\LocationController;
use App\Http\Controllers\Trip\Amin\TripController;
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
Route::prefix('location')->group(function () {
    Route::get('/', [LocationController::class, 'list_location'])->name('list_location');
    Route::get('add',[LocationController::class, 'form_create'])->name('form_create');
    Route::post('store',[LocationController::class, 'create_location'])->name('create_location');
    Route::get('edit/{id}',[LocationController::class, 'edit_location'])->name('edit_location');
    Route::post('update/{id}',[LocationController::class, 'save_edit_location'])->name('save_edit_location');
    Route::get('delete/{id}',[LocationController::class, 'delete_location'])->name('delete_location');
});

Route::prefix('trip')->group(function () {
    Route::get('/', [TripController::class, 'list_trip'])->name('list_trip');
    Route::get('add',[TripController::class, 'form_create_trip'])->name('form_create_trip');
    Route::post('store',[TripController::class, 'create_trip'])->name('create_trip');
    Route::get('edit/{id}',[TripController::class, 'edit_trip'])->name('edit_trip');
    Route::post('update/{id}',[TripController::class, 'save_edit_trip'])->name('save_edit_trip');
    Route::get('delete/{id}',[TripController::class, 'delete_trip'])->name('delete_trip');
});

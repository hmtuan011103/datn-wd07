<?php

use App\Http\Controllers\Locations\Client\LocationController;
use App\Http\Controllers\Trip\Client\TripController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Client Routes  ( With default url: http://127.0.0.1:8000 + route )
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('client.pages.home.index');
});

Route::get('/search', function () {
    return view('client.pages.search-route.index');
});

Route::get('/select-seat', function () {
    return view('client.pages.select-seat.index');
});

// Route::prefix('lich_trinh')->group(function () {
    Route::get('/lich-trinh', [TripController::class, 'lich_trinh'])->name('lich_trinh');
   
    // Route::get('/search_end_trip', [TripController::class, 'search_end_trip'])->name('search_end_trip');

// });
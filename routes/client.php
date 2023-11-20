<?php

use App\Http\Controllers\Locations\Client\LocationController;
use App\Http\Controllers\New\Admin\NewController;
// use App\Http\Controllers\New\Client\NewController;
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

Route::get('/tim-kiem', function () {
    return view('client.pages.search-route.index');
})->name('search');

Route::get('/chon-ghe', function () {
    return view('client.pages.select-seat.index');
});

Route::get('tin-tuc',[NewController::class,'index'])->name('client.news');
Route::get('tin-tuc/{slug?}',[NewController::class,'detail'])->name('client.news.detail');
Route::get('/dang-nhap', function () {
    return view('client.pages.auth.login');
})->name('auth');
Route::get('/lich-trinh', [TripController::class, 'lich_trinh'])->name('lich_trinh');

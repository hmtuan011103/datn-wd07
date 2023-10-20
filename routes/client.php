<?php

use App\Http\Controllers\Locations\Client\LocationController;
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
});

Route::get('/chon-ghe', function () {
    return view('client.pages.select-seat.index');
});

Route::get('news',[App\Http\Controllers\New\Client\NewController::class,'index'])->name('client.news');

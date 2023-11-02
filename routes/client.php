<?php

use App\Http\Controllers\Checkout\CheckoutController;
use App\Http\Controllers\Locations\Client\LocationController;
use App\Http\Controllers\Trip\Client\TripController;
use App\Http\Controllers\Contact\Client\ContactController;

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
})->name('trang_chu');

Route::get('/tim-kiem', function () {
    return view('client.pages.search-route.index');
})->name('search');

Route::get('/chon-ghe', function () {
    return view('client.pages.select-seat.index');
});
Route::get('/dang-nhap', function () {
    return view('client.pages.auth.login');
})->name('auth');
Route::get('/lich-trinh', [TripController::class, 'lich_trinh'])->name('lich_trinh');
Route::post('/thanh-toan', [CheckoutController::class, 'checkout'])->name('thanh_toan');
Route::get('/trang-thai-thanh-toan', [CheckoutController::class, 'checkoutSuccess'])->name('trang_thai_thanh_toan');


Route::get('/lien-he', function () {
    return view('client.pages.contact.index');
})->name('lien_he');
Route::get('ve-chung-toi', function () {
    return view('client.pages.about.index');
})->name('ve_chung_toi');
Route::get('huong-dan-dat-ve', function () {
    return view('client.pages.guide.index');
})->name('huong_dan_mua_hang');
Route::post('post_contact', [ContactController::class, 'store'])->name('create_contact');


Route::get('/tra-cuu', function () {
    return view('client.pages.search-ticket.index');
});


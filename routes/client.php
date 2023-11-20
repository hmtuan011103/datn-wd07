<?php

use App\Http\Controllers\Checkout\CheckoutController;
use App\Http\Controllers\Locations\Client\LocationController;
use App\Http\Controllers\Trip\Client\TripController;
use App\Http\Controllers\Contact\Client\ContactController;

use App\Http\Controllers\New\Client\NewController;
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
    $title = "Chiến thắng | Trang chủ";
    return view('client.pages.home.index', compact('title'));
})->name('trang_chu');

Route::get('/tim-kiem', function () {
    $title = "Chiến thắng | Tìm kiếm chuyến xe";
    return view('client.pages.search-route.index', compact('title'));
})->name('search');

Route::get('/chon-ghe', function () {
    $title = "Chiến thắng | Chọn ghế chuyến xe";
    return view('client.pages.select-seat.index', compact('title'));
});
Route::get('/dang-nhap', function () {
    $title = "Chiến thắng | Đăng nhập/Đăng ký";
    return view('client.pages.auth.login', compact('title'));
})->name('dang-nhap');
Route::match(['get', 'post'], '/thong-tin', function () {
    $title = "Chiến thắng | Thông Tin Người Dùng";
    return view('client.pages.profile.profile', compact('title'));
})->name('thong-tin')->middleware('checklogin');
Route::match(['get', 'post'], '/ma-giam-gia', function () {
    $title = "Chiến thắng | Mã Giảm Giá";
    return view('client.pages.discount.index', compact('title'));
})->name('ma-giam-gia')->middleware('checklogin');
Route::match(['get', 'post'], '/mat-khau', function () {
    $title = "Chiến thắng | Đổi Mật Khẩu";
    return view('client.pages.profile.password', compact('title'));
})->name('mat-khau')->middleware('checklogin');
Route::match(['get', 'post'], '/lich-su', function () {
    $title = "Chiến thắng | Lịch Sử Đặt Vé";
    return view('client.pages.booking-history.index', compact('title'));
})->name('lich-su')->middleware('checklogin');

Route::get('/lich-trinh', [TripController::class, 'lich_trinh'])->name('lich_trinh');
Route::post('/thanh-toan', [CheckoutController::class, 'checkout'])->name('thanh_toan');
Route::get('/trang-thai-thanh-toan', [CheckoutController::class, 'checkoutSuccess'])->name('trang_thai_thanh_toan');


Route::get('/lien-he', function () {
    $title = "Chiến thắng | Liên Hệ";
    return view('client.pages.contact.index', compact('title'));
})->name('lien_he');
Route::get('ve-chung-toi', function () {
    $title = "Chiến thắng | Về Chúng Tôi";
    return view('client.pages.about.index', compact('title'));
})->name('ve_chung_toi');
Route::get('huong-dan-mua-ve', function () {
    $title = "Chiến thắng | Hướng Dẫn Mua Vé";
    return view('client.pages.guide.index', compact('title'));
})->name('huong_dan_mua_ve');
Route::post('post_contact', [ContactController::class, 'store'])->name('create_contact');


Route::get('/tra-cuu', function () {
    $title = "Chiến thắng | Tra Cứu Vé Xe";
    return view('client.pages.search-ticket.index', compact('title'));
});


Route::get('tin-tuc',[NewController::class,'index'])->name('client.news');
Route::get('tin-tuc/{slug?}',[NewController::class,'detail'])->name('client.news.detail');

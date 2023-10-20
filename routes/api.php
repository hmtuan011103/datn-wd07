<?php

use App\Http\Controllers\Locations\Admin\LocationController;
use App\Http\Controllers\Locations\Client\LocationController as ClientLocationController;
use App\Http\Controllers\Trip\Client\TripController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// soft delete multiple for type user
Route::delete('type_users/destroy-multiple', [\App\Http\Controllers\TypeUser\Admin\TypeUserController::class, 'destroyMultiple'])->name('api.type_users.destroy.multiple');
// soft delete multiple for user
Route::delete('users/destroy-multiple', [\App\Http\Controllers\User\Admin\UserController::class, 'destroyMultiple'])->name('api.users.destroy.multiple');

Route::get('/location/list_client_location',[ClientLocationController::class, 'list_client_location'])->name('api.location.list');
Route::get('searchtrip',[TripController::class, 'searchtrip'])->name('search_trip');


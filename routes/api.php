<?php

use App\Http\Controllers\API\hotelController;
use App\Http\Controllers\API\orderController;
use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\customerController;
use Illuminate\Auth\Events\Login;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
 // untuk tabel customer ( bebas akses).
 Route::group(['prefix' => 'v1'], function ($router) {
    
    Route::get('customer', [customerController::class, 'index']);
Route::get('customer/{id}', [customerController::class, 'show']);
});
// Harus Login.
Route::group(['middleware' => 'api','prefix' => 'v1'], function ($router) {
//untuk table customer
Route::post('customer', [customerController::class, 'store']);
Route::put('customer/{id}', [customerController::class, 'update']);
Route::delete('customer/{id}', [customerController::class, 'destroy']);
Route::get('customerR', [customerController::class, 'indexRelasi']);
// untuk tabel products 
Route::get('hotel', [hotelController::class, 'index']);
Route::get('hotel/{id}', [hotelController::class, 'show']);
Route::post('hotel', [hotelController::class, 'store']);
Route::put('hotel/{id}', [hotelController::class, 'update']);
Route::delete('hotel/{id}', [hotelController::class, 'destroy']);
//tes relasi antar tabel
Route::get('hotelR', [hotelController::class, 'indexRelasi']);

// untuk tabel order tanpa penggunaan resource
Route::get('order', [orderController::class, 'index']);
Route::get('order/{id}', [orderController::class, 'show']);
Route::post('order', [orderController::class, 'store']);
Route::put('order/{id}', [orderController::class, 'update']);
Route::delete('order/{id}', [orderController::class, 'destroy']);
//tes relasi antar tabel
Route::get('orderR', [orderController::class, 'indexRelasi']);
});


Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('refresh', [AuthController::class, 'refresh']);
Route::post('me', [AuthController::class, 'me']);

Route::get('password', function () {
    return bcrypt('geo123');
});

});
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh_token', [AuthController::class, 'refresh_token']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::resource('products', ProductController::class)->except(['create', 'edit']);

Route::group(['prefix' => 'cart'], function () {
    Route::get('/', [CartController::class, 'index']);
    Route::post('/addToCart/{id}', [CartController::class, 'addToCart']);
    Route::delete('/deleteCartItem/{id}', [CartController::class, 'deleteCartItem']);
    Route::patch('/updateCartItem/{id}', [CartController::class, 'updateCartItem']);
    Route::post('/checkout', [CartController::class, 'checkout']);
});

Route::post('/test', [CartController::class, 'test']);

Route::resource('orders', OrderController::class)->only(['index', 'store', 'update']);
// Route::resource('coupons', CouponController::class)->except(['create', 'edit']);

// Route::post('/order', [OrderController::class, 'addToOrder']);
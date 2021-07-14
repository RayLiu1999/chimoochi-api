<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CouponController;
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

Route::get('products', [ProductController::class, 'index']);
Route::get('products/{id}', [ProductController::class, 'show']);

Route::group(['prefix' => 'cart'], function () {
    Route::get('/', [CartController::class, 'index']);
    Route::post('/addToCart/{id}', [CartController::class, 'addToCart']);
    Route::delete('/deleteCartItem/{id}', [CartController::class, 'deleteCartItem']);
    Route::patch('/updateCartItem/{id}', [CartController::class, 'updateCartItem']);
    Route::post('/applyCoupon', [CartController::class, 'applyCoupon']);
    Route::post('/checkout', [CartController::class, 'checkout']);
});


Route::group(['prefix' => 'admin', 'middleware' => ['auth.jwt', 'is_admin']], function () {
    Route::resource('products', ProductController::class)->except(['create', 'edit', 'show']);
    Route::get('orders', [OrderController::class, 'index']);
    Route::patch('order/{id}', [OrderController::class, 'update']);
    Route::resource('coupons', CouponController::class)->except(['create', 'show', 'edit']);
});


Route::get('test', [ProductController::class, 'test']);
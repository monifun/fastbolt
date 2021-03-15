<?php

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

Route::post('login', [\App\Http\Controllers\API\AuthController::class, 'login'])->name('login');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('cart', [\App\Http\Controllers\API\User\CartController::class, 'show'])->name('cart.show');
    Route::post('cart', [\App\Http\Controllers\API\User\CartController::class, 'addProduct'])->name('cart.products.add');
    Route::put('cart/{product}', [\App\Http\Controllers\API\User\CartController::class, 'updateProduct'])->name('cart.products.update');
    Route::delete('cart/{product}', [\App\Http\Controllers\API\User\CartController::class, 'destroyProduct'])->name('cart.products.destroy');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

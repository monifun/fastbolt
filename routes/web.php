<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return \Inertia\Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => \Illuminate\Foundation\Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::group(['middleware' => ['auth', 'can:viewAdmin'], 'prefix' => config('fastbolt.admin_prefix'), 'as' => 'admin.'], function () {
    Route::get('dashboard', \App\Http\Controllers\Admin\DashboardController::class)->name('dashboard');
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('markets', \App\Http\Controllers\Admin\MarketController::class);
    Route::resource('vendors', \App\Http\Controllers\Admin\VendorController::class);
    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
    Route::resource('orders.charges', \App\Http\Controllers\Admin\OrderChargeController::class);
    Route::resource('orders.transactions', \App\Http\Controllers\Admin\OrderTransactionController::class);
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    Route::resource('products.charges', \App\Http\Controllers\Admin\ProductChargeController::class);
});

Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('dashboard', \App\Http\Controllers\User\DashboardController::class)->name('dashboard');
    Route::get('profile', [\App\Http\Controllers\User\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\User\ProfileController::class, 'update'])->name('profile.update');
    Route::put('password', \App\Http\Controllers\User\PasswordController::class)->name('password.update');
    Route::get('wallet', [\App\Http\Controllers\User\WalletController::class, 'show'])->name('wallet.show');
    Route::get('orders', [\App\Http\Controllers\User\OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [\App\Http\Controllers\User\OrderController::class, 'show'])->name('orders.show');
    Route::post('orders/{order}/payments', [\App\Http\Controllers\User\OrderPaymentController::class, 'store'])->name('orders.payments.store');
});

require __DIR__.'/auth.php';

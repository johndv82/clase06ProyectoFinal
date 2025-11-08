<?php

use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Shop\CartController;
use App\Http\Controllers\Shop\OrderController;
use App\Http\Controllers\Shop\ProductController as ShopProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [ShopProductController::class, 'index'])->name('home');

Auth::routes();


//ADMIN
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function(){
    Route::resource('products', AdminProductController::class);
    Route::resource('users', UserController::class)->except(['create', 'store']);
});


//SHOP

Route::middleware(['auth'])->prefix('shop')->name('shop.')->group(function(){

    Route::get('/', [ShopProductController::class, 'index'])->name('products.index');
    //Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    //Ordenes

    Route::post('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});
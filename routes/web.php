<?php

use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function(){
    Route::resource('products', ProductController::class);
});



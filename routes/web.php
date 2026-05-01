<?php

use App\Http\Controllers\homeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get("/",[homeController::class,"homepage"])->name("homepage");
Route::get("/signup",[homeController::class,"signUp"])->name("signUp");
Route::get("/showlogin",[homeController::class,"Showlogin"])->name("login");
Route::get("/dashboard",[homeController::class,"dashboard"])->name("dashboard");
Route::post('/login',[homeController::class,"login"])->name('login1');
Route::resource("/buyers",UsersController::class);
Route::resource('products', ProductController::class);
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/showlogin'); 
})->name('logout');
Route::post('/checkout', [OrderController::class, 'checkout']);
Route::get('/orders', [OrderController::class, 'ordersPage'])->name('orders');
Route::post('/orders/send-response/{id}', [OrderController::class, 'sendResponse']);
Route::get('/order-history', [OrderController::class, 'orderHistory'])->name('order.history');



<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PenjualController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// pembeli
Route::get('/', [HomeController::class, 'index'])->middleware('guest');
// produk
Route::get('/products', [ProductController::class, 'produk'])->middleware('guest');
Route::get('/info_produk/{product:id}', [ProductController::class, 'info'])->middleware('guest');
// pesanan
Route::get('/order/{product:id}', [OrderController::class, 'create'])->middleware('guest');
Route::post('/order', [OrderController::class, 'store'])->middleware('guest');
Route::get('/payment', [PaymentController::class, 'show'])->middleware('guest');
Route::post('/payment/confirm', [PaymentController::class, 'confirm'])->middleware('guest');
Route::get('/success', [OrderController::class, 'success'])->middleware('guest');


// adderss
Route::get('/provinces', [AddressController::class, 'getProvinces']);
Route::get('/cities/{provinceId}', [AddressController::class, 'getCities']);
Route::get('/calculate-shipping/{cityId}/{courier}/{weight}', [AddressController::class, 'calculateShipping']);


// penjual
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/profile', [PenjualController::class, 'profile'])->middleware('auth');
Route::get('/edit_profile', [PenjualController::class, 'edit'])->middleware('auth');
// produk
Route::get('/kelola_produk', [ProductController::class, 'index'])->middleware('auth');
Route::post('/search', [ProductController::class, 'search'])->middleware('auth');
Route::post('/tambah_produk', [ProductController::class, 'store'])->middleware('auth');
Route::delete('/hapus_produk/{product:id}', [ProductController::class, 'destroy'])->middleware('auth');
Route::get('/detail_produk/{product:id}', [ProductController::class, 'show'])->middleware('auth');
Route::get('/edit_produk/{product:id}', [ProductController::class, 'edit'])->middleware('auth');
Route::put('/edit_produk/{product:id}', [ProductController::class, 'update'])->middleware('auth');
// pesanan
Route::get('/kelola_pesanan', [OrderController::class, 'index'])->middleware('auth');
Route::get('/orders/{id}', [OrderController::class, 'show'])->middleware('auth');
Route::post('/update_pesanan', [OrderController::class, 'updateStatus'])->middleware('auth');
Route::get('/search_order', [OrderController::class, 'search'])->middleware('auth');


// auth
Route::get('/tambahadmin', [UserController::class, 'create'])->middleware('auth');
Route::post('/tambahadmin', [UserController::class, 'store'])->middleware('auth');
Route::get('/login', [UserController::class, 'login'])->middleware('guest');
Route::post('/login', [UserController::class, 'authenticate'])->middleware('guest');
Route::post('/logout', [UserController::class, 'logout']);
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PenjualController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// pembeli
Route::get('/', [HomeController::class, 'index']);
// produk
Route::get('/products', [ProductController::class, 'produk']);
Route::get('/info_produk/{product:id}', [ProductController::class, 'info']);
// pesanan
Route::get('/order/{product:id}', [OrderController::class, 'create']);
Route::post('/order', [OrderController::class, 'store']);
Route::get('/payment', [PaymentController::class, 'show']);
Route::post('/payment/confirm', [PaymentController::class, 'confirm']);
Route::get('/success', [OrderController::class, 'success']);


// adderss
Route::get('/provinces', [AddressController::class, 'getProvinces']);
Route::get('/cities/{provinceId}', [AddressController::class, 'getCities']);
Route::get('/subdistricts/{cityId}', [AddressController::class, 'getSubdistricts']);
Route::get('/calculate-shipping/{cityId}/{courier}/{weight}', [AddressController::class, 'calculateShipping']);
Route::post('/checkout', [AddressController::class, 'storeOrder']);


// penjual
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/profile', [PenjualController::class, 'profile']);
Route::get('/edit_profile', [PenjualController::class, 'edit']);
// produk
Route::get('/kelola_produk', [ProductController::class, 'index']);
Route::post('/search', [ProductController::class, 'search']);
Route::post('/tambah_produk', [ProductController::class, 'store']);
Route::delete('/hapus_produk/{product:id}', [ProductController::class, 'destroy']);
Route::get('/detail_produk/{product:id}', [ProductController::class, 'show']);
Route::get('/edit_produk/{product:id}', [ProductController::class, 'edit']);
Route::put('/edit_produk/{product:id}', [ProductController::class, 'update']);
// pesanan
Route::get('/kelola_pesanan', [OrderController::class, 'index']);
Route::post('/update_pesanan', [OrderController::class, 'updateStatus']);


// auth
Route::get('/login', [DashboardController::class, 'login']);
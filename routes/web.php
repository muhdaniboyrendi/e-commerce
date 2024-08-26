<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\PenjualController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// pembeli
Route::get('/', [HomeController::class, 'index']);
// produk
Route::get('/products', [ProdukController::class, 'index']);
Route::get('/detail_produk/{product:id}', [ProdukController::class, 'show']);
// pesanan
Route::post('/order/{id}', [ProdukController::class, 'showOrderForm']);
Route::post('/process-order', [ProdukController::class, 'processOrder']);
Route::get('/pesanan', [ProdukController::class, 'status']);
Route::get('/beli', [ProdukController::class, 'create']);
Route::get('/success', [ProdukController::class, 'success']);


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
Route::post('/kelola_produk', [PenjualController::class, 'store']);
Route::delete('/hapus_produk/{product:id}', [PenjualController::class, 'destroy']);
Route::get('/info_produk/{product:id}', [PenjualController::class, 'show']);
Route::get('/edit_produk/{product:id}', [PenjualController::class, 'edit']);
Route::put('/edit_produk/{product:id}', [PenjualController::class, 'update']);
// pesanan
Route::get('/kelola_pesanan', [PenjualController::class, 'pesanan']);


// auth
Route::get('/login', [DashboardController::class, 'login']);
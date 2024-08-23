<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PenjualController;
use App\Http\Controllers\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// pembeli
Route::get('/', [HomeController::class, 'index']);
Route::get('/products', [ProdukController::class, 'index']);
Route::get('/detail_produk/{product:id}', [ProdukController::class, 'show']);
Route::post('/order/{id}', [ProdukController::class, 'showOrderForm']);
Route::post('/process-order', [ProdukController::class, 'processOrder']);
Route::get('/pesanan', [ProdukController::class, 'status']);
Route::get('/beli', [ProdukController::class, 'create']);


// penjual
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/kelola_produk', [PenjualController::class, 'produk']);
Route::post('/kelola_produk', [PenjualController::class, 'store']);
Route::delete('/hapus_produk/{product:id}', [PenjualController::class, 'destroy']);
Route::get('/info_produk/{product:id}', [PenjualController::class, 'show']);
Route::get('/edit_produk/{product:id}', [PenjualController::class, 'edit']);
Route::put('/edit_produk/{product:id}', [PenjualController::class, 'update']);
Route::get('/kelola_pesanan', [PenjualController::class, 'pesanan']);
Route::get('/profile', [PenjualController::class, 'profile']);
Route::get('/edit_profile', [PenjualController::class, 'edit']);


// auth
Route::get('/login', [DashboardController::class, 'login']);

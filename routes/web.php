<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PenjualController;
use App\Http\Controllers\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// pembeli
Route::get('/', [HomeController::class, 'index']);
Route::get('/products', [ProdukController::class, 'index']);
Route::get('/detail_produk', [ProdukController::class, 'show']);
Route::get('/pesanan', [ProdukController::class, 'status']);
Route::get('/beli', [ProdukController::class, 'create']);


// penjual
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/kelola_produk', [PenjualController::class, 'produk']);
Route::get('/kelola_pesanan', [PenjualController::class, 'pesanan']);
Route::get('/profile', [PenjualController::class, 'profile']);
Route::get('/edit_profile', [PenjualController::class, 'edit']);


// auth
Route::get('/login', [DashboardController::class, 'login']);

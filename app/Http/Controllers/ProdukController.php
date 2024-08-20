<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(){
        return view('customer.products', ['title' => 'Produk', 'active' => 'produk']);
    }

    public function show(){
        return view('customer.detail_produk', ['title' => 'Produk', 'active' => 'produk']);
    }

    public function create(){
        return view('customer.beli', ['title' => 'Beli Sekarang', 'active' => 'pesanan']);
    }

    public function status(){
        return view('customer.pesanan', ['title' => 'Pesanan', 'active' => 'pesanan']);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(){
        return view('customer.products');
    }

    public function show(){
        return view('customer.detail_produk');
    }

    public function create(){
        return view('customer.beli');
    }
}

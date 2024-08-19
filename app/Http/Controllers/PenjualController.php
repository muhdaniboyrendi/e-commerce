<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenjualController extends Controller
{
    public function produk(){
        return view('admin.kelola_produk');
    }

    public function pesanan(){
        return view('admin.kelola_pesanan');
    }

    public function profile(){
        return view('admin.profile');
    }

    public function edit(){
        return view('admin.edit_profile');
    }
}

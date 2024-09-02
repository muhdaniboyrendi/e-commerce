<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('pembeli.home', ['title' => 'Home', 'active' => 'home']);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // tampilan halaman dashboard
    public function index(){
        return view('penjual.dashboard', ['title' => 'Dashboard', 'active' => 'dashboard']);
    }

    // tampilan halaman profile
    public function show(){
        return view('login', ['title' => 'Profile', 'active' => 'profile']);
    }

    // tampilan halaman edit profile
    public function edit(){
        return view('login', ['title' => 'Edit Profile', 'active' => 'profile']);
    }

    // fungsi update profile
    public function update(){
        return view('login', ['title' => 'Edit Profile', 'active' => 'profile']);
    }
}

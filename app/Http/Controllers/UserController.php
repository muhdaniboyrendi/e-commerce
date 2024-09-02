<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // halaman login
     public function login(){
        return view('login', ['title' => 'Login', 'active' => 'login']);
    }

    // fungsi login
    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/dashboard');
        }

        return back()->with('loginError', 'Login Failed!');
    }

    // fungsi logout
    public function logout(Request $request){
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }

    // tampilan tambah admin
    public function create(){
        return view('penjual.user.tambahadmin', ['title' => 'Tambah Admin', 'active' => 'admin']);
    }

    // fungsi tambah admin
    public function store(Request $request){
        // dd($request);
        $validatedData = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|max:255|confirmed',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);

        return redirect('/tambahadmin')->with('success', 'Admin baru berhasil ditambahkan!');
    }
}

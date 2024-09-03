<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
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

    // tampilan halaman profile
    public function profile($id){
        $user = User::findOrFail($id);
        $profile = Profile::where('user_id', $id)->get();
        // dd($profile);

        return view('penjual.user.profile', compact('profile'), ['title' => 'Profile', 'active' => 'profile']);
    }

    // fungsi menyimpan profile
    public function storeProfile(Request $request){
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'string|min:3|max:255|nullable',
            'email' => 'string|email|max:255|nullable',
            'address' => 'string|min:5|max:255|nullable',
            'telp' => 'string|min:5|max:255|nullable',
            'instagram' => 'string|min:5|max:255|nullable',
            'github' => 'string|min:5|max:255|nullable',
            'location' => 'string|min:5|max:255|nullable',
            'linkedin' => 'string|min:5|max:255|nullable',
        ]);

        $profileData = $request->only([
            'name',
            'email',
            'address',
            'telp',
            'instagram',
            'github',
            'location',
            'linkedin'
        ]);

        $profile = Profile::updateOrCreate(
            ['user_id' => $request->user_id],
            $profileData
        );

        return back()->with('success', 'Informasi profile berhasil diperbaharui!');
    }

    // tampilan tambah admin
    public function create(){
        return view('penjual.user.tambahadmin', ['title' => 'Tambah Admin', 'active' => 'admin']);
    }

    // fungsi tambah admin
    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|max:255|confirmed',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);

        return redirect('/tambahadmin')->with('success', 'Admin baru berhasil ditambahkan!');
    }

    // tampilan edit profile
    public function edit(){
        return view('penjual.user.edit_profile', ['title' => 'Edit Account', 'active' => 'profile']);
    }

    // Fungsi untuk update profile
    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Ambil pengguna yang sedang login
        $user = Auth::user();

        // Perbarui atribut pengguna
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Periksa apakah password diinputkan dan perlu diperbarui
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Simpan perubahan
        $user->save();

        // Redirect kembali dengan pesan sukses
        return redirect('edit_profile')->with('success', 'Profile updated successfully!');
    }
}

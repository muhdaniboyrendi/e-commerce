<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // tampilan halaman dashboard
    public function index(){
        // produk
        $macamProduk = Product::count();
        $pakaianAtas = Product::where('category_id', 1)->count();
        $pakaianBawah = Product::where('category_id', 2)->count();
        $aksesoris = Product::where('category_id', 3)->count();

        // pesanan
        $menungguKonfirmasi = Order::where('status_id', 1)->count();
        $terkonfirmasi = Order::where('status_id', 2)->count();
        $dikemas = Order::where('status_id', 3)->count();
        $dikirim = Order::where('status_id', 4)->count();

        // pemasukan harian
        $pemasukan = Order::sum('total_price');

        // histori transaksi
        $histories = Order::where('status_id', 4)->get();

        return view('penjual.dashboard', compact('macamProduk', 'pakaianAtas', 'pakaianBawah', 'aksesoris', 'menungguKonfirmasi', 'terkonfirmasi', 'dikemas', 'dikirim', 'pemasukan', 'histories'), ['title' => 'Dashboard', 'active' => 'dashboard']);
    }
}

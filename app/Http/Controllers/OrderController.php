<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Method untuk menampilkan form checkout
    public function showCheckoutForm(Request $request)
    {
        // Mengambil data produk dan varian yang dipilih
        $product = Product::findOrFail($request->input('product_id'));
        $variant = $product->product_variants()->findOrFail($request->input('variant_id'));
        $quantity = $request->input('quantity');

        // Menampilkan view dengan data yang diperlukan
        return view('customer.checkout', compact('product', 'variant', 'quantity'), ['title' => 'Produk', 'active' => 'produk']);
    }

    // Method untuk memproses checkout
    public function processCheckout(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'payment_method' => 'required|string',
            'shipping_service' => 'required|string',
            'product_id' => 'required|exists:products,id',
            'variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Proses checkout dan simpan ke database
        // Contoh: Simpan data order di tabel 'orders'
        // Anda perlu membuat model dan tabel Order sesuai kebutuhan

        // Redirect ke halaman sukses atau tampilkan pesan sukses
        return redirect('/products')->with('success', 'Pesanan Anda berhasil diproses!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductVariant;

class ProdukController extends Controller
{

    // Method untuk menampilkan halaman pemesanan
    public function showOrderForm(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $variantId = $request->input('variant_id');
        $quantity = $request->input('quantity');
 
        // Temukan varian produk yang dipilih
        $variant = $product->product_variants()->where('id', $variantId)->first();
 
        return view('customer.checkout', compact('product', 'variant', 'quantity'), ['title' => 'Buat Pesanan', 'active' => 'produk']);
    }
 
    // Method untuk memproses pemesanan
    public function processOrder(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'required|integer|min:1',
            'customer_name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'payment_method' => 'required|string',
            'shipping_service' => 'required|string',
        ]);
 
        // Temukan produk dan varian
        $product = Product::findOrFail($validatedData['product_id']);
        $variant = $product->product_variants()->where('id', $validatedData['variant_id'])->first();
 
        // Cek ketersediaan stok
        if ($variant->stock < $validatedData['quantity']) {
            return back()->with('error', 'Stok tidak mencukupi untuk varian yang dipilih.');
        }
 
        // Kurangi stok
        $variant->stock -= $validatedData['quantity'];
        $variant->save();
 
        // Hitung total harga
        $totalPrice = $product->price * $validatedData['quantity'];
 
        // Simpan data pesanan
        $order = Order::create([
            'product_id' => $product->id,
            'variant_id' => $variant->id,
            'quantity' => $validatedData['quantity'],
            'customer_name' => $validatedData['customer_name'],
            'address' => $validatedData['address'],
            'payment_method' => $validatedData['payment_method'],
            'shipping_service' => $validatedData['shipping_service'],
            'total_price' => $totalPrice,
        ]);
 
        // Redirect dengan pesan sukses
        return redirect('/products')->with('success', 'Pesanan berhasil diproses!');
    }

    public function success(){
        return view('customer.success', ['title' => 'Pemesanan Sukses', 'active' => 'pesanan']);
    }
}

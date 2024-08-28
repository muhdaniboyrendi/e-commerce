<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Address;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // tampilan halamn penesanan
    public function create($productId, Request $request)
    {
        $product = Product::findOrFail($productId);
        $variant = ProductVariant::findOrFail($request->variant_id);
        $quantity = $request->quantity;

        return view('pembeli.pesanan.checkout', compact('product', 'variant', 'quantity'), ['title' => 'Checkout', 'active' => 'pesanan']);
    }

    // Method untuk memproses checkout
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'required|integer|min:1',
            'name' => 'required|string',
            'telp' => 'required|string',
            'email' => 'required|email',
            'provinsi' => 'required|string',
            'kota' => 'required|string',
            'kecamatan' => 'required|string',
            'desa' => 'required|string',
            'kode_pos' => 'required|string',
            'alamat' => 'required|string',
            'courier' => 'required|string',
            'payment_method' => 'required|string',
        ]);


        DB::transaction(function () use ($request) {
            // Mengurangi stok varian produk
            $variant = ProductVariant::findOrFail($request->variant_id);
            if ($variant->stock < $request->quantity) {
                return back()->withErrors(['message' => 'Stok tidak mencukupi']);
            }
            $variant->stock -= $request->quantity;
            $variant->save();

            // Menghitung total harga
            $totalPrice = $variant->product->price * $request->quantity;

            // Menyimpan data ke tabel orders
            $order = Order::create([
                'product_id' => $request->product_id,
                'variant_id' => $request->variant_id,
                'quantity' => $request->quantity,
                'name' => $request->name,
                'telp' => $request->telp,
                'email' => $request->email,
                'courier' => $request->courier,
                'payment_method' => $request->payment_method,
                'total_price' => $totalPrice,
            ]);

            // Simpan ID order untuk digunakan dalam redirect
            $orderId = $order->id;

            // Menyimpan data ke tabel addresses
            Address::create([
                'order_id' => $order->id,
                'provinsi' => $request->provinsi,
                'kota' => $request->kota,
                'kecamatan' => $request->kecamatan,
                'desa' => $request->desa,
                'kode_pos' => $request->kode_pos,
                'alamat' => $request->alamat,
            ]);
        });

        // Cek metode pembayaran dan arahkan ke halaman yang sesuai
        if ($request->payment_method === 'bank_transfer') {
            return redirect()->route('order.payment', ['order_id' => $orderId, 'total_price' => $totalPrice]);
        }
        
        return redirect('/success')->with('success', 'Pesanan Anda berhasil dibuat!');
    }

    // tampilan halaman pembayaran
    public function payment($order_id, $total_price)
    {
        return view('order.payment', compact('order_id', 'total_price'));
    }

    // tampilan pesanan sukses
    public function success(){
        return view('pembeli.pesanan.success', ['title' => 'Pemesanan Sukses', 'active' => 'pesanan']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Address;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Services\RajaOngkirService;

class OrderController extends Controller
{
    // pembeli
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
        $validatedData = $request->validate([
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
            'total_price' => 'required|string',
        ]);
        
        // Mengurangi stok varian produk
        $variant = productVariant::findOrFail($validatedData['variant_id']);
        if ($variant->stock < $validatedData['quantity']) {
            return back()->withErrors(['message' => 'Stok tidak mencukupi']);
        }
        $variant->stock -= $validatedData['quantity'];
        $variant->save();

        // Create an order
        $order = Order::create([
            'product_id' => $validatedData['product_id'],
            'variant_id' => $validatedData['variant_id'],
            'quantity' => $validatedData['quantity'],
            'name' => $validatedData['name'],
            'telp' => $validatedData['telp'],
            'email' => $validatedData['email'],
            'courier' => $validatedData['courier'],
            'payment_method' => $validatedData['payment_method'],
            'total_price' => $validatedData['total_price'],
        ]);

        // Simpan ID order untuk digunakan dalam redirect
        $orderId = $order->id;

        // Menyimpan data ke tabel addresses
        Address::create([
            'order_id' => $order->id,
            'provinsi' => $validatedData['provinsi'],
            'kota' => $validatedData['kota'],
            'kecamatan' => $validatedData['kecamatan'],
            'desa' => $validatedData['desa'],
            'kode_pos' => $validatedData['kode_pos'],
            'alamat' => $validatedData['alamat'],
        ]);

        // Redirect based on payment method
        if ($validatedData['payment_method'] == 'bank_transfer') {
            return redirect('/payment')->with(['order_id' => $orderId, 'total_price' => $validatedData['total_price']]);
        }

        return redirect('/success')->with('total_price', $validatedData['total_price']);
    }

    // tampilan pesanan sukses
    public function success(){
        return view('pembeli.pesanan.success', ['title' => 'Pemesanan Sukses', 'active' => 'pesanan']);
    }


    // penjual
    // tampilan halaman kelola pesanan
    public function index()
    {
        // Fetch all orders (paginate if necessary)
        $orders = Order::with('product', 'variant', 'address')->orderBy('created_at', 'desc')->get();

        return view('penjual.pesanan.index', compact('orders'), ['title' => 'Pesanan', 'active' => 'kelola_pesanan']);
    }

    protected $rajaOngkirService;

    public function __construct(RajaOngkirService $rajaOngkirService)
    {
        $this->rajaOngkirService = $rajaOngkirService;
    }

    // tampilan detail pesanan
    public function show($id)
    {
        $order = Order::with(['product', 'variant', 'address'])->find($id);

        $provinces = $this->rajaOngkirService->getProvinces($order->address->provinsi);

        // $apiKey = '1a35ccbdb2d7db90a98ec0d929e8d866';
        // $provinceId = $order->address->provinsi;
        // $cityId = $order->address->kota;

        // $response = Http::withHeaders([
        //     'key' => $apiKey
        // ])->get("https://api.rajaongkir.com/starter/province", [
        //     'id' => $provinceId
        // ]);

        $provinceName = response()->json($provinces['rajaongkir']['results']['province']);

        if ($order) {
            return response()->json([
                'name' => $order->name,
                'telp' => $order->telp,
                'email' => $order->email,
                'provinsi' => $provinceName,
                'kota' => $provinceName,
                'kecamatan' => $order->address->kecamatan,
                'desa' => $order->address->desa,
                'kode_pos' => $order->address->kode_pos,
                'alamat' => $order->address->alamat,
                'product_name' => $order->product->name ?? 'N/A',
                'variant' => $order->variant->name ?? 'N/A',
                'total_price' => number_format($order->total_price, 0, ',', '.'),
                'status' => ucfirst($order->status),
                'payment_proof' => $order->payment_proof,
                'quantity' => $order->quantity,
                'courier' => $order->courier,
                'payment_method' => $order->payment_method,
                'price' => $order->product->price,
            ]);
        }

        return response()->json(['message' => 'Pesanan tidak ditemukan.'], 404);
    }

    // Update the status of an order
    public function updateStatus(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'status' => 'required|string',
        ]);

        // Find the order and update its status
        $order = Order::findOrFail($validatedData['order_id']);
        $order->status = $validatedData['status'];
        $order->save();

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}

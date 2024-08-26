<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Services\RajaOngkirService;

class AddressController extends Controller
{
    protected $rajaOngkirService;

    public function __construct(RajaOngkirService $rajaOngkirService)
    {
        $this->rajaOngkirService = $rajaOngkirService;
    }

    public function getProvinces()
    {
        $provinces = $this->rajaOngkirService->getProvinces();
        return response()->json($provinces['rajaongkir']['results']);
    }

    public function getCities($provinceId)
    {
        $cities = $this->rajaOngkirService->getCities($provinceId);
        return response()->json($cities['rajaongkir']['results']);
    }

    public function getSubdistricts($cityId)
    {
        $subdistricts = $this->rajaOngkirService->getSubdistricts($cityId);
        return response()->json($subdistricts['rajaongkir']['results']);
    }

    public function calculateShipping($cityId, $courier, $weight)
    {
        $shippingCost = $this->rajaOngkirService->calculateShipping($cityId, $courier, $weight);
        return response()->json([
            'cost' => $shippingCost['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value']
        ]);
    }

    public function storeOrder(Request $request)
    {
        
        // Validate request data
        $validatedData = $request->validate([
            'product_id' => 'required|integer',
            'variant_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
            'name' => 'required|string',
            'no_hp' => 'required|string',
            'email' => 'required|email',
            'payment_method' => 'required|string',
            'courier' => 'required|string',
            'total_price' => 'required|string',
            'address.*.province' => 'required|string',
            'address.*.city' => 'required|string',
            'address.*.subdistrict' => 'required|string',
            'address.*.village' => 'required|string',
            'address.*.postal_code' => 'required|string',
            'address.*.address' => 'required|string',
        ]);
        dd($validatedData);

        $totalPayment = $validatedData['total_price'];

        // Calculate total payment
        $productPrice = $this->getProductPrice($request->input('product_id'), $request->input('quantity'));
        $shippingCost = $this->rajaOngkirService->calculateShipping(
            $request->input('city'),
            $request->input('courier'),
            1000 // default weight in grams
        );
        $totalPayment = $productPrice + $shippingCost['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'];

        // Save order to database (implement according to your schema)
        $order = Order::create([
            'product_id' => $validatedData['product_id'],
            'variant_id' => $validatedData['variant_id'],
            'quantity' => $validatedData['quantity'],
            'name' => $validatedData['name'],
            'no_hp' => $validatedData['no_hp'],
            'email' => $validatedData['email'],
            'payment_method' => $validatedData['payment_method'],
            'courier' => $validatedData['courier'],
            'total_payment' => $validatedData['total_price'],
        ]);

        foreach ($validatedData['adderss'] as $alamat) {
            $order->address()->create([
                'province' => $alamat['province'],
                'city' => $alamat['city'],
                'subdistrict' => $alamat['subdistrict'],
                'village' => $alamat['village'],
                'postal_code' => $alamat['postal_code'],
                'address' => $alamat['address'],
            ]);
        }

        // Update product variant stock
        $product = Product::findOrFail($validatedData['product_id']);
        $variant = $product->product_variants()->where('id', $validatedData['variant_id'])->first();
 
        // Cek ketersediaan stok
        if ($variant->stock < $validatedData['quantity']) {
            return back()->with('error', 'Stok tidak mencukupi untuk varian yang dipilih.');
        }
 
        // Kurangi stok
        $variant->stock -= $validatedData['quantity'];
        $variant->save();

        // Redirect or return response
        return redirect('/success')->with('total_payment', $totalPayment);
    }

    private function getProductPrice($productId, $quantity)
    {
        // Fetch product price from the database or any other source
        // For example:
        // return Product::find($productId)->price * $quantity;
        return 100000 * $quantity; // Dummy price for demonstration
    }
}

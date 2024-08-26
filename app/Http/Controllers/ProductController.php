<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductVariant;

use function Laravel\Prompts\error;

class ProductController extends Controller
{
    // penjual
    // Tampilan halaman Kelola Produk
    public function index(){
        $products = Product::with(['category', 'product_variants'])->paginate(10);

        $product = new Product();
        $categories = Category::all();
        $product_variant = new ProductVariant();
        
        return view('penjual.produk.index', compact('product', 'categories', 'product_variant', 'products'), ['title' => 'Kelola Produk', 'active' => 'kelola_produk']);
    }

    // fungsi tambah produk
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'variants' => 'array',
            'variants.*.name' => 'required|string|max:255',
            'variants.*.stock' => 'required|integer|min:0',
        ]);

        $product = Product::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'image' => $request->file('image')->store('product-images', 'public'),
            'category_id' => $validatedData['category_id'],
        ]);

        if ($request->has('product_variants')) {
            foreach ($request->product_variants as $variant) {
                ProductVariant::create([
                    'name' => $variant['name'],
                    'stock' => $variant['stock'],
                    'product_id' => $product->id,
                ]);
            }
        }

        return redirect('/kelola_produk')->with('success', 'Product Berhasil ditambahkan.');
    }

    // fungsi hapus produk

    // tampilan halaman edit produk

    // fungsi update produk

    // tampilan halaman detail produk


    // pembeli
    // tampilan halaman produk

    // tampilan halaman info produk
}

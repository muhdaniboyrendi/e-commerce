<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductVariant;

class PenjualController extends Controller
{
    public function produk()
    {
        $products = Product::with(['category', 'product_variants'])->get();

        $product = new Product();
        $categories = Category::all();
        $product_variant = new ProductVariant();
        return view('admin.kelola_produk', compact('product', 'categories', 'product_variant', 'products'), ['title' => 'Kelola Produk', 'active' => 'kelola_produk']);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|max:2048',
            'product_variants.*.size' => 'required|string|max:50',
            'product_variants.*.color' => 'required|string|max:50',
            'product_variants.*.stock' => 'required|integer|min:0',
        ]);
    
        $product = Product::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'category_id' => $validatedData['category_id'],
            'image' => $request->file('image')->store('product-images', 'public'),
        ]);
    
        foreach ($validatedData['product_variants'] as $variant) {
            $product->product_variants()->create([
                'size' => $variant['size'],
                'color' => $variant['color'],
                'stock' => $variant['stock'],
            ]);
        }
    
        return redirect('/kelola_produk')->with('success', 'Produk baru berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->product_variants()->delete();
        $product->delete();

        return redirect('/kelola_produk')->with('success', 'Produk berhasil dihapus!');
    }

    public function edit($id)
    {
        $product = Product::with(['category', 'product_variants'])->findOrFail($id);
        $categories = Category::all();

        return view('admin.edit_produk', compact('product', 'categories'), ['title' => 'Edit Produk', 'active' => 'kelola_produk']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|max:2048',
            'product_variants.*.size' => 'required|string|max:50',
            'product_variants.*.color' => 'required|string|max:50',
            'product_variants.*.stock' => 'required|integer|min:0',
        ]);

        $product = Product::findOrFail($id);

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => $request->image,
        ]);

        foreach ($request->product_variants as $variantId => $variantData) {
            if (isset($variantData['id'])) {
                // Update existing variant
                $variant = ProductVariant::findOrFail($variantData['id']);
                $variant->update([
                    'size' => $variantData['size'],
                    'color' => $variantData['color'],
                    'stock' => $variantData['stock'],
                ]);
            } else {
                // Create new variant
                $product->variants()->create([
                    'size' => $variantData['size'],
                    'color' => $variantData['color'],
                    'stock' => $variantData['stock'],
                ]);
            }
        }

        return redirect('/kelola_produk')->with('success', 'Produk berhasil diperbarui.');
    }

    public function pesanan(){
        return view('admin.kelola_pesanan', ['title' => 'Kelola Pesanan', 'active' => 'kelola_pesanan']);
    }

    public function profile(){
        return view('admin.profile', ['title' => 'Profile']);
    }

    public function editProfile(){
        return view('admin.edit_profile', ['title' => 'Edit Profile']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Storage;

class PenjualController extends Controller
{
    // halaman utama kelola produk
    public function produk()
    {
        $products = Product::with(['category', 'product_variants'])->paginate(10);

        $product = new Product();
        $categories = Category::all();
        $product_variant = new ProductVariant();
        return view('admin.kelola_produk', compact('product', 'categories', 'product_variant', 'products'), ['title' => 'Kelola Produk', 'active' => 'kelola_produk']);
    }

    // fungsi tambah produk
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|max:2048',
            'category_id' => 'required|exists:categories,id',
            'product_variants.*.name' => 'required|string|max:50',
            'product_variants.*.stock' => 'required|integer|min:0',
        ]);
    
        $product = Product::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'image' => $request->file('image')->store('product-images', 'public'),
            'category_id' => $validatedData['category_id'],
        ]);
    
        foreach ($validatedData['product_variants'] as $variant) {
            $product->product_variants()->create([
                'name' => $variant['name'],
                'stock' => $variant['stock'],
            ]);
        }
    
        return redirect('/kelola_produk')->with('success', 'Produk baru berhasil ditambahkan!');
    }

    // fungsi hapus produk
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->product_variants()->delete();
        $product->delete();

        return redirect('/kelola_produk')->with('success', 'Produk berhasil dihapus!');
    }

    // halaman detail produk
    public function show($id)
    {
        $product = Product::with(['category', 'product_variants'])->findOrFail($id);
        
        return view('admin.info_produk', compact('product'), ['title' => 'Detail Produk', 'active' => 'kelola_produk']);
    }

    // halaman edit produk
    public function edit($id)
    {
        $product = Product::with('product_variants')->findOrFail($id);
        $categories = Category::all();

        return view('admin.edit_produk', compact('product', 'categories'), ['title' => 'Edit Produk', 'active' => 'kelola_produk']);
    }

    // fungsi update produk
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
            'category_id' => 'required|exists:categories,id',
            'product_variants.*.id' => 'nullable|exists:product_variants,id',
            'product_variants.*.name' => 'required|string|max:50',
            'product_variants.*.stock' => 'required|integer|min:0',
        ]);    
    
        // Temukan produk berdasarkan ID
        $product = Product::findOrFail($id);
    
        // Perbarui data produk
        $product->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'category_id' => $validatedData['category_id'],
        ]);
    
        // Jika ada gambar baru, hapus gambar lama dan simpan yang baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $product->image = $request->file('image')->store('product-images', 'public');
            $product->save();
        }
    
        // Perbarui atau buat varian produk
        $existingVariantIds = $product->product_variants->pluck('id')->toArray();
        $updatedVariantIds = [];

        foreach ($validatedData['product_variants'] as $variantData) {
            if (isset($variantData['id'])) {
                // Update varian yang sudah ada
                $variant = ProductVariant::findOrFail($variantData['id']);
                $variant->update([
                    'name' => $variantData['name'],
                    'stock' => $variantData['stock'],
                ]);
                $updatedVariantIds[] = $variant->id;
            } else {
                // Buat varian baru
                $newVariant = $product->product_variants()->create([
                    'name' => $variantData['name'],
                    'stock' => $variantData['stock'],
                ]);
                $updatedVariantIds[] = $newVariant->id;
            }
        }

        // Hapus varian yang tidak ada lagi
        $variantsToDelete = array_diff($existingVariantIds, $updatedVariantIds);
        ProductVariant::destroy($variantsToDelete);

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

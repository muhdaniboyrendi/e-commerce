<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Storage;

class PenjualController extends Controller
{

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

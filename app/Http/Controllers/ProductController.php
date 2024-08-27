<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\error;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

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
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_variants' => 'required|array|min:1',
            'product_variants.*.name' => 'required|string|max:255',
            'product_variants.*.stock' => 'required|integer|min:0',
        ]);

        $product = Product::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'image' => $request->file('image')->store('product-images', 'public'),
            'category_id' => $validatedData['category_id'],
        ]);

        // Tambahkan varian produk
        foreach ($validatedData['product_variants'] as $variant) {
            $product->product_variants()->create([
                'name' => $variant['name'],
                'stock' => $variant['stock'],
            ]);
        }

        return redirect('/kelola_produk')->with('success', 'Product Berhasil ditambahkan.');
    }

    // fungsi hapus produk
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        ProductVariant::where('product_id', $product->id)->delete();

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        // Redirect dengan pesan sukses
        return redirect('/kelola_produk')->with('success', 'Produk berhasil dihapus.');
    }

    // fungsi pencarian data produk pada tabel
    public function search(Request $request){
        $search = $request->input('search');

        $filter = $search;

        $product = new Product();
        $categories = Category::all();
        $product_variant = new ProductVariant();

        // Query untuk mendapatkan produk berdasarkan pencarian
        $products = Product::with(['category', 'product_variants'])
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%')
                            ->orWhereHas('category', function ($query) use ($search) {
                                $query->where('name', 'like', '%' . $search . '%');
                            })
                            ->orWhereHas('product_variants', function ($query) use ($search) {
                                $query->where('name', 'like', '%' . $search . '%');
                            });
            })
            ->paginate(10);

        $message = $products->isEmpty() ? 'Data tidak ditemukan!' : '';

        // Kembali ke view dengan data produk
        return view('penjual.produk.index', compact('products', 'product', 'categories', 'product_variant', 'message', 'filter'), ['title' => 'Kelola Produk', 'active' => 'kelola_produk']);
    }

    // tampilan halaman detail produk
    public function show($id)
    {
        $product = Product::with(['category', 'product_variants'])->findOrFail($id);
        
        return view('penjual.produk.detail_produk', compact('product'), ['title' => 'Detail Produk', 'active' => 'kelola_produk']);
    }

    // tampilan halaman edit produk
    public function edit($id)
    {
        $product = Product::with('product_variants')->findOrFail($id);
        $categories = Category::all();

        return view('penjual.produk.edit_produk', compact('product', 'categories'), ['title' => 'Edit Produk', 'active' => 'kelola_produk']);
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
    
        // Simpan path gambar baru jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            // Simpan gambar baru
            $imagePath = $request->file('image')->store('product-images', 'public');
        } else {
            // Gunakan gambar lama jika tidak ada gambar baru
            $imagePath = $product->image;
        }

        // Update data produk
        $product->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'image' => $imagePath,
            'category_id' => $validatedData['category_id'],
        ]);
    
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


    // pembeli
    // tampilan halaman produk

    // tampilan halaman info produk
}

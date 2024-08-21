<x-layout_dua>
    <x-slot:title>{{ $title }}</x-slot>
    <x-slot:active>{{ $active }}</x-slot>
      
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-2">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="#">Toko Erlan</a></li>
                      <li class="breadcrumb-item"><a href="#">Produk</a></li>
                      <li class="breadcrumb-item"><a href="#">Aksesoris</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Asus Vivobook OLED 15</li>
                    </ol>
                </nav>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="../img/thumbnail/laptop.jpg" alt="Gambar Produk" class="img-fluid">
                        </div>
                        <div class="col-md-8">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="/edit_produk/{{ $product['id'] }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="name" class="form-label">Nama Produk</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Nama Produk" value="{{ old('name', $product->name) }}" required>
                                    @error('name')
                                        <div>{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description" class="form-label">Deskripsi Produk</label>
                                    <textarea name="description" class="form-control" id="description" rows="10" required>{{ old('description', $product->description) }}</textarea>
                                    @error('description')
                                        <div>{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="price" class="form-label">Harga Produk</label>
                                    <input type="text" name="price" class="form-control" id="price" placeholder="Nama Produk" value="{{ old('price', $product->price) }}" required>
                                    @error('price')
                                        <div>{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="category_id">Kategori</label>
                                    <select name="category_id" id="category_id" class="form-control" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Bagian untuk mengelola varian produk -->
                                <div class="form-group">
                                    <label>Varian Produk</label>
                                    <div id="variants-container">
                                        @foreach($product->product_variants as $variant)
                                            <div class="variant-item">
                                                <input type="hidden" name="variants[{{ $variant->id }}][id]" value="{{ $variant->id }}">
                                                <div class="form-group">
                                                    <input type="text" name="variants[{{ $variant->id }}][variant_name]" class="form-control" value="{{ old('variants.' . $variant->id . '.variant_name', $variant->variant_name) }}" required>
                                                </div>
                                                <button type="button" class="btn btn-danger btn-sm remove-variant">Hapus Varian</button>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-primary btn-sm" id="add-variant">Tambah Varian</button>
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout_dua>
<x-layout_dua>
    <x-slot:title>{{ $title }}</x-slot>
    <x-slot:active>{{ $active }}</x-slot>
      
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-2">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="#">Toko Erlan</a></li>
                      <li class="breadcrumb-item"><a href="#">Account</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                </nav>
            </div>
            <div class="card">
                <div class="card-body">

                    @if (session()->has('success'))
                        <div class="row">
                            <div class="col">
                                <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-success">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <img src="https://via.placeholder.com/150" class="rounded-circle mb-3" alt="Foto Profil">
                                    <h4>{{ auth()->user()->name }}</h4>
                                    <p class="text-muted">Penjual</p>
                                    <a href="/edit_profile" class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Edit Account</a>
                                </div>
                            </div>
                            <div class="card mt-3">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Informasi Kontak</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="bi bi-envelope me-2"></i> {{ auth()->user()->email }}</li>
                                        <li><i class="bi bi-phone me-2"></i> {{ $profile[0]['telp'] }}</li>
                                        <li><i class="bi bi-geo-alt me-2"></i> {{ $profile[0]['address'] }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Detail Profil</h5>
                                    <form method="post" action="/profile">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                        <div class="mb-3">
                                            <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                                            <input type="text" name="name" class="form-control" id="namaLengkap" value="{{ auth()->user()->name }}" placeholder="Nama Lengkap">
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" id="email" value="{{ auth()->user()->email }}" placeholder="Email">
                                        </div>
                                        <div class="mb-3">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <textarea class="form-control" name="address" id="alamat" rows="3" placeholder="Kabupaten, Provinsi, Negara">{{ $profile[0]['address'] }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="telepon" class="form-label">Nomor Telepon</label>
                                            <input type="tel" name="telp" class="form-control" id="telepon" value="{{ $profile[0]['telp'] }}" placeholder="Nomor Telepon / WhatsApp">
                                        </div>
                                        <div class="mb-3">
                                            <label for="instagram" class="form-label">Instagram</label>
                                            <input type="text" name="instagram" class="form-control" id="instagram" value="{{ $profile[0]['instagram'] }}" placeholder="Link Akun Instagram">
                                        </div>
                                        <div class="mb-3">
                                            <label for="github" class="form-label">Github</label>
                                            <input type="text" name="github" class="form-control" id="github" value="{{ $profile[0]['github'] }}" placeholder="Link Akun Github">
                                        </div>
                                        <div class="mb-3">
                                            <label for="location" class="form-label">Location</label>
                                            <input type="text" name="location" class="form-control" id="location" value="{{ $profile[0]['location'] }}" placeholder="Link Lokasi di Maps">
                                        </div>
                                        <div class="mb-3">
                                            <label for="linkedin" class="form-label">LinkedIn</label>
                                            <input type="text" name="linkedin" class="form-control" id="linkedin" value="{{ $profile[0]['linkedin'] }}" placeholder="Link Akun LinkedIn">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout_dua>
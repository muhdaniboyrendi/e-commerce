<x-layout>
    <x-slot:title>{{ $title }}</x-slot>
    <x-slot:active>{{ $active }}</x-slot>
      
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-2">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="#">Toko Erlan</a></li>
                      <li class="breadcrumb-item"><a href="#">User</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Edit Account</li>
                    </ol>
                </nav>
            </div>

            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">x</button>
                </div>
            @endif

            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-2">
                <div>
                  <h1 class="fw-bold mb-3">Edit Account</h1>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                  <button type="button" class="btn btn-label-info btn-round me-2" data-bs-toggle="modal" data-bs-target="#adminModal">Tambah Admin</button>
                </div>
            </div>
        
            <div class="row">
                        
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <form action="/edit_profile" method="POST">
                                @csrf
                                @method('put')
                                <div class="mb-3">
                                    <label for="fullName" class="form-label">Nama Lengkap</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="fullName" value="{{ auth()->user()->name }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                        
                                <div class="mb-3">
                                    <label for="email" class="form-label">Alamat Email</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ auth()->user()->email }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <hr class="mt-4">
                                        
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                        
                                <div class="mb-3">
                                    <label for="confirmPassword" class="form-label">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" class="form-control @error('password') is-invalid @enderror" id="confirmPassword">
                                </div>
                                        
                                <button type="submit" class="btn btn-primary">simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="adminModal" tabindex="-1" aria-labelledby="adminModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h1 class="modal-title fs-5" id="adminModalLabel">Tambah Admin</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Jika anda menambahkan admin maka akan ada orang lain yang bisa memelola aplikasi toko anda. Apakah anda yakin?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <a href="/tambahadmin" class="btn btn-primary">Yes</a>
                </div>
            </div>
        </div>
    </div>


</x-layout>
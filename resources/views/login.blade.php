<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #3B71CA;
        }
        .login-container {
            max-width: 500px;
            margin-top: 100px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 login-container">
                <div class="card shadow">
                    <div class="card-body m-3">
                        <h2 class="text-center mb-4">Login</h2>
                        <form method="post" action="/login">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Alamat Email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="nama@contoh.com" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Kata Sandi</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan kata sandi" required>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">Ingat saya</label>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Masuk</button>
                            </div>
                        </form>
                        <div class="text-center mt-3">
                            <a href="#" class="text-decoration-none">Lupa kata sandi?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
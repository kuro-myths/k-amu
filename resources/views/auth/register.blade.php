<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>K-amu | Daftar</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-dark d-flex align-items-center justify-content-center vh-100">

    <div class="card shadow-lg border-success w-100" style="max-width: 420px;">
        <div class="card-body p-4">

            <h3 class="text-center text-success mb-4">
                <i class="bi bi-person-plus"></i> Daftar K-AMU
            </h3>

            @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <form method="POST" action="{{ route('register.process') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('name')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                    @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Kata Sandi</label>
                    <input type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" required>
                    @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Konfirmasi Kata Sandi</label>
                    <input type="password" name="password_confirmation" class="form-control form-control-lg" required>
                </div>

                <button type="submit" class="btn btn-success w-100 fw-bold mb-3">
                    DAFTAR SEKARANG
                </button>
            </form>

            <!-- LOGIN LINK -->
            <div class="text-center">
                <span class="text-muted">Sudah punya akun?</span><br>
                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm mt-1">
                    Login Sekarang
                </a>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
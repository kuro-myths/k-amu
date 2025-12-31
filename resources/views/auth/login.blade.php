<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>K-amu | Login</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-dark d-flex align-items-center justify-content-center vh-100">

    <div class="card shadow-lg border-warning w-100" style="max-width: 420px;">
        <div class="card-body p-4">

            <h3 class="text-center text-warning mb-4">
                <i class="bi bi-door-open"></i> K-AMU
            </h3>

            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <form method="POST" action="{{ route('login.process') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" class="form-control form-control-lg" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Kata Sandi</label>
                    <input type="password" name="password" class="form-control form-control-lg" required>
                </div>

                <button type="submit" class="btn btn-warning w-100 fw-bold mb-3">
                    BUKA GERBANG
                </button>
            </form>

            <!-- REGISTER LINK -->
            <div class="text-center mb-3">
                <span class="text-muted">Belum punya akun?</span><br>
                <a href="{{ route('register') }}" class="btn btn-outline-primary btn-sm mt-1">
                    Daftar Sekarang
                </a>
            </div>

            <hr>

            <!-- TEST ACCOUNT INFO -->
            <div class="alert alert-info alert-sm mb-3">
                <strong>Akun Test:</strong><br>
                <small>
                    Email: <code>superadmin@k-amu.test</code><br>
                    Password: <code>password</code>
                </small>
            </div>

            <!-- SOCIAL LOGIN ICON ONLY -->
            <div class="d-flex justify-content-center gap-3">
                <a href="/auth/google" class="btn btn-outline-danger">
                    <i class="bi bi-google"></i>
                </a>

                <a href="/auth/github" class="btn btn-outline-dark">
                    <i class="bi bi-github"></i>
                </a>

                <a href="/auth/apple" class="btn btn-outline-secondary">
                    <i class="bi bi-apple"></i>
                </a>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
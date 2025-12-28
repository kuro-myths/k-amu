<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>K-amu | Register</title>

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-dark d-flex align-items-center justify-content-center vh-100">

    <div class="card shadow-lg border-warning w-100" style="max-width: 420px;">
        <div class="card-body p-4">

            <!-- TITLE -->
            <h3 class="text-center text-warning mb-4">
                <i class="bi bi-person-plus"></i> K-AMU
            </h3>

            <!-- FORM REGISTER -->
            <form method="POST" action="{{ route('register.process') }}">
                @csrf

                <!-- NAMA -->
                <div class="row mb-2">
                    <div class="col-6">
                        <input type="text" name="name" class="form-control"
                            placeholder="Nama Lengkap" required>
                    </div>
                    <div class="col-6">
                        <input type="text" name="nickname" class="form-control"
                            placeholder="Nama Panggilan">
                    </div>
                </div>

                <!-- EMAIL -->
                <div class="mb-2">
                    <input type="email" name="email" class="form-control"
                        placeholder="Email" required>
                </div>

                <!-- ROLE + TAHUN -->
                <div class="row mb-2">
                    <div class="col-6">
                        <select name="role" class="form-select" required>
                            <option value="">Peran</option>
                            <option value="mahasiswa">Mahasiswa</option>
                            <option value="dosen">Dosen</option>
                            <option value="keluarga">Keluarga</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <input type="number" name="tahun" class="form-control"
                            placeholder="Tahun" min="1900" max="2100" required>
                    </div>
                </div>

                <!-- PASSWORD -->
                <div class="row mb-3">
                    <div class="col-6">
                        <input type="password" name="password" class="form-control"
                            placeholder="Password" required>
                    </div>
                    <div class="col-6">
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="Konfirmasi" required>
                    </div>
                </div>

                <!-- BUTTON -->
                <button class="btn btn-warning w-100 fw-bold mb-3">
                    DAFTAR
                </button>
            </form>

            <!-- LINK KE LOGIN -->
            <div class="text-center mb-3">
                <span class="text-muted small">Sudah punya akun?</span><br>
                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm mt-1">
                    Masuk
                </a>
            </div>

            <hr>

            <!-- SOCIAL REGISTER (POSISI & GAYA SAMA LOGIN) -->
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
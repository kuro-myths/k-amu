<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-AMU | Materi Digital & Fitur Unggulan</title>

    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Alpine.js CDN untuk interaktivitas murni (opsional untuk submit form tanpa internal JS) -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js" defer></script>
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">K-AMU</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="#">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Materi</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Proyek</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Inovasi</a></li>
                </ul>
                <div class="d-flex gap-2">
                    <a href="{{ route('login') }}" class="btn btn-outline-warning btn-sm">Masuk</a>
                    <a href="{{ route('register') }}" class="btn btn-warning btn-sm">Daftar</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="container text-center py-5 my-5">
        <h1 class="display-4 fw-bold mb-3">Selamat Datang di K-AMU</h1>
        <p class="lead mb-4">Platform digital untuk mengeksplorasi materi, proyek, dan inovasi baru.</p>
        <div class="d-flex justify-content-center gap-2">
            <a href="{{ route('register') }}" class="btn btn-warning btn-lg">Mulai Sekarang</a>
            <a href="#" class="btn btn-outline-secondary btn-lg">Pelajari Lebih Lanjut</a>
        </div>
    </header>

    <!-- Fitur Utama -->
    <section class="container my-5">
        <div class="row text-center g-4">
            <div class="col-md-4">
                <div class="card h-100 text-dark">
                    <div class="card-body">
                        <i class="bi bi-file-earmark-text-fill fs-1 mb-3"></i>
                        <h5 class="card-title">Materi Digital</h5>
                        <p class="card-text">Eksplorasi konten digital interaktif.</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">Lihat Materi</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 text-dark">
                    <div class="card-body">
                        <i class="bi bi-lightbulb-fill fs-1 mb-3"></i>
                        <h5 class="card-title">Proyek Kreatif</h5>
                        <p class="card-text">Buat dan bagikan proyek inovatif.</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">Lihat Proyek</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 text-dark">
                    <div class="card-body">
                        <i class="bi bi-gear-fill fs-1 mb-3"></i>
                        <h5 class="card-title">Inovasi Baru</h5>
                        <p class="card-text">Jelajahi ide baru dan eksperimen digital.</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">Lihat Inovasi</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fitur Unggulan: Diagram & Pesan -->
    <section class="container my-5" x-data="{ submitted: false }">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card h-100 p-3">
                    <h5 class="card-title text-center mb-3">Diagram Support</h5>
                    <canvas id="supportChart" height="300" x-init="
            new Chart($el.getContext('2d'), {
              type: 'bar',
              data: {
                labels: ['Materi', 'Proyek', 'Inovasi', 'Feedback'],
                datasets: [{
                  label: 'Support Aktivitas',
                  data: [75, 60, 90, 50],
                  backgroundColor: 'rgba(0,123,255,0.7)',
                  borderColor: 'rgba(0,123,255,1)',
                  borderWidth: 1
                }]
              },
              options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
            })
          "></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100 p-3">
                    <h5 class="card-title text-center mb-3">Kirim Pesan</h5>
                    <form x-on:submit.prevent="submitted = true">
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Nama" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" placeholder="Pesan..." rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" x-show="!submitted">Kirim</button>
                        <div class="alert alert-success mt-2" x-show="submitted">Pesan berhasil dikirim!</div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-light text-center py-4 mt-auto">
        &copy; 2025 K-AMU System. Semua hak dilindungi.
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
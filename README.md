# K-AMU - Sistem Manajemen Pembelajaran Terintegrasi

K-AMU adalah sistem manajemen pembelajaran terintegrasi yang dirancang untuk mendukung aktivitas belajar mengajar yang lebih efektif. Sistem ini menyediakan berbagai fitur untuk mendukung pembelajaran dari berbagai perspektif pengguna.

## Fitur Utama

### 1. **Dashboard Role-Based**
- **SuperAdmin**: Kelola seluruh sistem, pengguna, laporan, dan pengaturan
- **Leader**: Kelola proyek, catatan, analisis, bimbingan, dan obrolan
- **Mastercard**: Kelola pengguna, alat, aktivitas, dan obrolan
- **Tester**: Tools testing, dokumentasi, laporan, monitoring, statistik
- **User**: Catatan, laporan, obrolan untuk siswa, orang tua, dan alumni

### 2. **Navbar & Sidebar Per-Role**
- Navbar yang customized untuk setiap role dengan icon dan judul unik
- Sidebar dengan menu spesifik sesuai kebutuhan role
- Toggle responsive untuk mobile dan tablet

### 3. **Fitur Keamanan**
- Authentication dan Authorization
- Role-based access control
- Permission system

### 4. **Manajemen Konten**
- Catatan dan dokumentasi
- Laporan dan statistik
- Aktivitas logging
- Notifikasi real-time

## Struktur Folder

```
k-amu/
├── app/
│   ├── Http/Controllers/
│   ├── Models/
│   ├── Policies/
│   └── Helpers/
├── resources/
│   ├── views/
│   │   ├── components/
│   │   │   ├── navbars/     (Navbar per-role)
│   │   │   └── sidebars/    (Sidebar per-role)
│   │   ├── layouts/
│   │   ├── superadmin/
│   │   ├── leader/
│   │   ├── mastercard/
│   │   ├── tester/
│   │   └── user/
│   ├── css/
│   └── js/
├── routes/
│   ├── web.php
│   ├── superadmin.php
│   ├── leader.php
│   ├── mastercard.php
│   ├── tester.php
│   └── user.php
├── database/
│   ├── migrations/
│   ├── seeders/
│   └── database.sqlite
└── public/
    ├── css/
    └── js/
```

## Tech Stack

- **Backend**: Laravel 11
- **Frontend**: Bootstrap 5, Blade Templates
- **Icons**: Bootstrap Icons
- **Database**: SQLite
- **CSS Utilities**: Tailwind CSS (optional)

## Instalasi

### Requirements
- PHP 8.2+
- Composer
- Node.js & NPM

### Setup

1. Clone repository
```bash
git clone https://github.com/kuro-myths/k-amu.git
cd k-amu
```

2. Install dependencies
```bash
composer install
npm install
```

3. Setup environment
```bash
cp .env.example .env
php artisan key:generate
```

4. Database setup
```bash
php artisan migrate
php artisan db:seed
```

5. Build assets
```bash
npm run dev
```

6. Start development server
```bash
php artisan serve
```

Server akan berjalan di `http://localhost:8000`

## User Roles

### 1. SuperAdmin
**Akses**: Penuh ke semua fitur
- Kelola pengguna dan role
- View laporan dan statistik
- Pengaturan sistem
- Catatan aktivitas

### 2. Leader
**Akses**: Manajemen proyek dan tim
- Buat dan kelola proyek
- Bimbingan tim
- Analisis proyek
- Obrolan dengan tim

### 3. Mastercard
**Akses**: Manajemen pengguna dan alat
- Kelola pengguna
- Manajemen alat/tools
- Catatan aktivitas
- Obrolan

### 4. Tester
**Akses**: Testing dan dokumentasi
- Testing tools dan sandbox
- Dokumentasi
- Laporan bug
- Monitoring dan statistik

### 5. User (Siswa/Orang Tua/Alumni)
**Akses**: Fitur pembelajaran dan komunikasi
- Catatan pribadi
- Laporan pembelajaran
- Obrolan
- Profil pribadi

## API Routes

### SuperAdmin Routes
```
/superadmin/beranda
/superadmin/pengguna
/superadmin/catatan
/superadmin/laporan
/superadmin/pengaturan
```

### Leader Routes
```
/leader/beranda
/leader/proyek
/leader/catatan
/leader/analisis
/leader/bimbingan
/leader/obrolan
/leader/bantuan
```

### Mastercard Routes
```
/mastercard/beranda
/mastercard/pengguna
/mastercard/alat
/mastercard/catatan-aktivitas
/mastercard/obrolan
/mastercard/bantuan
```

### Tester Routes
```
/tester/beranda
/tester/tools
/tester/sandbox
/tester/dokumentasi
/tester/laporan
/tester/monitoring
/tester/statistik
/tester/obrolan
/tester/pengaturan
```

### User Routes
```
/user/beranda
/user/catatan
/user/laporan
/user/obrolan
/user/profil
/user/alumni
```

## Fitur Sidebar Toggle

Sidebar dapat dibuka/ditutup dengan:
- **Click** button hamburger di navbar
- **Click** overlay untuk menutup
- **Press ESC** untuk menutup
- **Auto-close** saat click menu item di mobile
- **Auto-adapt** saat resize window

## Customization

### Customize Navbar
Edit file navbar sesuai role:
```
resources/views/components/navbars/navbar-{role}.blade.php
```

### Customize Sidebar
Edit file sidebar sesuai role:
```
resources/views/components/sidebars/sidebar-{role}.blade.php
```

### Customize Styling
Edit file CSS:
```
public/css/navbar.css
public/css/sidebar.css
public/css/dashboard.css
public/css/global.css
```

## Database Schema

### Users Table
- id
- name
- email
- password
- role (superadmin, leader, mastercard, tester, siswa, orang_tua, alumni)
- created_at, updated_at

### Activity Logs
- id
- user_id
- action
- description
- timestamp

### Notes
- id
- user_id
- title
- content
- created_at, updated_at

### Projects
- id
- leader_id
- title
- description
- status
- created_at, updated_at

### Bug Reports
- id
- user_id
- title
- description
- status
- created_at, updated_at

## Support & Kontribusi

Untuk pertanyaan atau bantuan, silakan buat issue di repository.

## License

MIT License - Copyright (c) 2025 K-AMU

## Version

**Current Version**: 1.0.0  
**Last Updated**: 29 Desember 2025

---

Dikembangkan dengan ❤️ untuk mendukung pembelajaran yang lebih baik.

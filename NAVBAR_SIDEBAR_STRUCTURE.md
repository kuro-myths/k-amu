# Struktur Navbar & Sidebar Per Role - K-amu

## 📁 Struktur Folder Baru

```
resources/views/components/
├── navbars/
│   ├── navbar-superadmin.blade.php  (Navbar khusus Super Admin)
│   ├── navbar-leader.blade.php      (Navbar khusus Leader)
│   ├── navbar-mastercard.blade.php  (Navbar khusus Mastercard)
│   ├── navbar-tester.blade.php      (Navbar khusus Tester)
│   ├── navbar-user.blade.php        (Navbar khusus User)
│   └── navbar.blade.php             (DEPRECATED - shared navbar)
├── sidebars/
│   ├── sidebar-superadmin.blade.php  (Menu khusus Super Admin)
│   ├── sidebar-leader.blade.php      (Menu khusus Leader)
│   ├── sidebar-mastercard.blade.php  (Menu khusus Mastercard)
│   ├── sidebar-tester.blade.php      (Menu khusus Tester)
│   └── sidebar-user.blade.php        (Menu khusus User - Siswa/Orang Tua/Alumni)
├── navbar.blade.php                  (DEPRECATED - kept for reference)
└── sidebar.blade.php                 (DEPRECATED - kept for reference)
```

---

## 🎯 Layout Loading Logic

### File: `resources/views/layouts/app.blade.php`

```blade
<!-- Navbar - Role-specific -->
@if(auth()->user()->role === 'superadmin')
    @include('components.navbars.navbar-superadmin')
@elseif(auth()->user()->role === 'leader')
    @include('components.navbars.navbar-leader')
@elseif(auth()->user()->role === 'mastercard')
    @include('components.navbars.navbar-mastercard')
@elseif(auth()->user()->role === 'tester')
    @include('components.navbars.navbar-tester')
@else
    @include('components.navbars.navbar-user')
@endif

<!-- Sidebar - Role-specific -->
@if(auth()->user()->role === 'superadmin')
    @include('components.sidebars.sidebar-superadmin')
@elseif(auth()->user()->role === 'leader')
    @include('components.sidebars.sidebar-leader')
@elseif(auth()->user()->role === 'mastercard')
    @include('components.sidebars.sidebar-mastercard')
@elseif(auth()->user()->role === 'tester')
    @include('components.sidebars.sidebar-tester')
@else
    @include('components.sidebars.sidebar-user')
@endif
```

---

## 📋 Navbar untuk Setiap Role

### 1. **Super Admin Navbar** (`navbar-superadmin.blade.php`)
```
- Icon: Shield Check (🛡️)
- Title: K-AMU Admin
- Search Placeholder: "Cari pengguna, laporan..."
- Notifications: Update Sistem, Bug Report
- Profile Menu: Profil Admin
```

### 2. **Leader Navbar** (`navbar-leader.blade.php`)
```
- Icon: Briefcase (💼)
- Title: K-AMU Leader
- Search Placeholder: "Cari proyek, catatan..."
- Notifications: Bimbingan Baru, Pesan Baru
- Profile Menu: Profil Leader
```

### 3. **Mastercard Navbar** (`navbar-mastercard.blade.php`)
```
- Icon: Credit Card (💳)
- Title: K-AMU Mastercard
- Search Placeholder: "Cari pengguna, alat..."
- Notifications: Update Alat, Aktivitas Penting
- Profile Menu: Profil Mastercard
```

### 4. **Tester Navbar** (`navbar-tester.blade.php`)
```
- Icon: Bug (🐛)
- Title: K-AMU Tester
- Search Placeholder: "Cari laporan, tools..."
- Notifications: Bug Baru, Monitoring Alert
- Profile Menu: Profil Tester
```

### 5. **User Navbar** (`navbar-user.blade.php`)
```
- Icon: People (👥)
- Title: K-AMU
- Search Placeholder: "Cari catatan, laporan..."
- Notifications: Informasi Baru, Pesan Baru
- Profile Menu: Profil
```

---

## 📋 Menu untuk Setiap Role

### 1. **Super Admin** (`sidebar-superadmin.blade.php`)
```
- Dashboard
- Kelola Pengguna
- Catatan
- Laporan
- Pengaturan
```

### 2. **Leader** (`sidebar-leader.blade.php`)
```
- Dashboard
- Proyek Saya
- Catatan
- Analisis
- Bimbingan
- Obrolan
- Bantuan
```

### 3. **Mastercard** (`sidebar-mastercard.blade.php`)
```
- Dashboard
- Kelola Pengguna
- Alat
- Catatan Aktivitas
- Obrolan
- Bantuan
```

### 4. **Tester** (`sidebar-tester.blade.php`)
```
- Dashboard
- Tools
- Sandbox
- Dokumentasi
- Laporan
- Monitoring
- Statistik
- Obrolan
- Pengaturan
```

### 5. **User** (`sidebar-user.blade.php`)
```
Dinamis berdasarkan sub-role:

[SISWA]
- Dashboard
- Catatan
- Laporan Nilai
- Obrolan

[ORANG TUA]
- Dashboard
- Catatan
- Laporan Anak
- Obrolan

[ALUMNI & UMUM]
- Dashboard
- Direktori Alumni
```

---

## ✅ Keuntungan Struktur Baru

1. **Separation of Concerns** - Setiap role punya menu yang spesifik dan clean
2. **Maintainability** - Mudah untuk update menu per-role tanpa affect role lain
3. **Performance** - Hanya load menu yang relevan untuk user
4. **Scalability** - Mudah untuk add role baru atau customize menu
5. **Security** - Menu yang ditampilkan sesuai dengan role user

---

## 🔧 Cara Modify Menu

### Tambah Menu Item pada Role Tertentu

Contoh: Tambah menu "Settings" untuk Leader

**File:** `resources/views/components/sidebars/sidebar-leader.blade.php`

```blade
<li class="menu-item">
    <a href="{{ route('leader.settings') }}" class="menu-link @if(request()->routeIs('leader.settings*')) active @endif">
        <i class="bi bi-gear"></i>
        <span>Settings</span>
    </a>
</li>
```

### Ubah Label Menu

**File:** `resources/views/components/sidebars/sidebar-superadmin.blade.php`

```blade
<div class="sidebar-header">
    <h5>Admin Control Panel</h5>  <!-- Ubah dari "Menu Admin" -->
    ...
</div>
```

---

## 🎨 CSS & JavaScript

Semua file CSS dan JavaScript **tetap sama**:
- `/public/css/sidebar.css` - Style untuk sidebar (shared)
- `/public/js/sidebar-toggle.js` - Toggle functionality (shared)
- `/public/css/navbar.css` - Style untuk navbar (shared)

Tidak ada perubahan pada styling atau interactivity.

---

## ⚙️ Routes yang Digunakan

Pastikan semua routes sudah terdefined di:
- `routes/superadmin.php`
- `routes/leader.php`
- `routes/mastercard.php`
- `routes/tester.php`
- `routes/user.php`

Contoh routes yang digunakan dalam sidebar:
```php
// routes/superadmin.php
Route::get('/beranda', [DashboardController::class, 'index'])->name('superadmin.beranda');
Route::get('/pengguna', [UserController::class, 'index'])->name('superadmin.pengguna');
...
```

---

## 📝 Catatan Penting

1. **Old Components** - File `components/navbar.blade.php` dan `components/sidebar.blade.php` sudah tidak digunakan, tapi bisa disimpan untuk reference
2. **Auth Check** - Semua component sudah include `@if(auth()->user()->role === ...)` untuk security
3. **Route Checking** - Menggunakan `request()->routeIs()` untuk highlight active menu
4. **Mobile Responsive** - Sidebar toggle (open/close) tetap berfungsi di semua device

---

## 🚀 Next Steps (Optional)

1. **Customize Routes** - Pastikan semua route di sidebar sesuai dengan naming convention Anda
2. **Update Menu Icons** - Ubah icons bootstrap sesuai preferensi
3. **Add Nested Menu** - Bisa tambahkan submenu dengan CSS dropdown
4. **Permissions** - Integrate dengan permission system jika ada

---

**Last Updated:** 29 Desember 2025
**Status:** ✅ Ready for Production


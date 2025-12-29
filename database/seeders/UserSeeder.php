<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Super Admin
        User::firstOrCreate(
            ['email' => 'superadmin@k-amu.test'],
            [
                'name' => 'Admin Utama',
                'password' => Hash::make('password'),
                'role' => 'superadmin',
                'user_type' => 'superadmin',
                'bio' => 'Administrator sistem K-AMU',
                'phone' => '081234567890',
                'address' => 'Jl. Admin No. 1',
                'level' => 10,
                'points' => 1000,
            ]
        );

        // Mastercard Users
        User::firstOrCreate(
            ['email' => 'mastercard@k-amu.test'],
            [
                'name' => 'Kepala Sekolah',
                'password' => Hash::make('password'),
                'role' => 'mastercard',
                'user_type' => 'mastercard',
                'bio' => 'Kepala sekolah yang mengelola sistem',
                'phone' => '081234567891',
                'address' => 'Jl. Sekolah No. 1',
                'level' => 9,
                'points' => 800,
            ]
        );

        // Leader Users (3 leaders untuk berbagai proyek)
        for ($i = 1; $i <= 3; $i++) {
            User::firstOrCreate(
                ['email' => "leader$i@k-amu.test"],
                [
                    'name' => "Pemimpin Proyek $i",
                    'password' => Hash::make('password'),
                    'role' => 'leader',
                    'user_type' => 'leader',
                    'bio' => "Pemimpin proyek nomor $i dengan pengalaman bagus",
                    'phone' => "081234567" . str_pad($i, 3, '0', STR_PAD_LEFT),
                    'address' => "Jl. Proyek No. $i",
                    'level' => 7,
                    'points' => 500,
                ]
            );
        }

        // Tester Users (3 testers untuk testing)
        for ($i = 1; $i <= 3; $i++) {
            User::firstOrCreate(
                ['email' => "tester$i@k-amu.test"],
                [
                    'name' => "Tester Nomor $i",
                    'password' => Hash::make('password'),
                    'role' => 'tester',
                    'user_type' => 'tester',
                    'bio' => "QA Tester dengan ketelitian tinggi",
                    'phone' => "081234567" . str_pad(900 + $i, 3, '0', STR_PAD_LEFT),
                    'address' => "Jl. Testing No. $i",
                    'level' => 6,
                    'points' => 400,
                ]
            );
        }

        // Siswa Users (5 siswa)
        for ($i = 1; $i <= 5; $i++) {
            User::firstOrCreate(
                ['email' => "siswa$i@k-amu.test"],
                [
                    'name' => "Siswa $i",
                    'password' => Hash::make('password'),
                    'role' => 'user',
                    'user_type' => 'siswa',
                    'bio' => "Siswa berprestasi kelas $i",
                    'phone' => "081234567" . str_pad(100 + $i, 3, '0', STR_PAD_LEFT),
                    'address' => "Jl. Sekolah No. " . (10 + $i),
                    'level' => 1,
                    'points' => 100 + ($i * 50),
                ]
            );
        }

        // Orang Tua Users (3 orang tua)
        for ($i = 1; $i <= 3; $i++) {
            User::firstOrCreate(
                ['email' => "ortu$i@k-amu.test"],
                [
                    'name' => "Orang Tua $i",
                    'password' => Hash::make('password'),
                    'role' => 'user',
                    'user_type' => 'orang_tua',
                    'bio' => "Orang tua siswa yang peduli pendidikan",
                    'phone' => "081234567" . str_pad(200 + $i, 3, '0', STR_PAD_LEFT),
                    'address' => "Jl. Perumahan No. $i",
                    'level' => 2,
                    'points' => 150,
                ]
            );
        }

        // Alumni Users (2 alumni)
        for ($i = 1; $i <= 2; $i++) {
            User::firstOrCreate(
                ['email' => "alumni$i@k-amu.test"],
                [
                    'name' => "Alumni $i",
                    'password' => Hash::make('password'),
                    'role' => 'user',
                    'user_type' => 'alumni',
                    'bio' => "Alumni sukses tahun 202$i",
                    'phone' => "081234567" . str_pad(300 + $i, 3, '0', STR_PAD_LEFT),
                    'address' => "Jl. Kampus No. $i",
                    'cv' => 'alumni' . $i . '_cv.pdf',
                    'level' => 3,
                    'points' => 250,
                ]
            );
        }
    }
}

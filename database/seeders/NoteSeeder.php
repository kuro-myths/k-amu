<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        // Superadmin notes
        $superAdmin = $users->where('role', 'superadmin')->first();
        Note::create([
            'user_id' => $superAdmin->id,
            'title' => 'Checklist Pemeliharaan Sistem',
            'content' => "1. Update server setiap bulan\n2. Backup database setiap hari\n3. Review security logs\n4. Update dependencies\n5. Monitor performance metrics",
            'category' => 'admin',
            'color' => 'red',
            'is_pinned' => true,
        ]);

        Note::create([
            'user_id' => $superAdmin->id,
            'title' => 'Password dan Akses Penting',
            'content' => 'Simpan di password manager yang aman',
            'category' => 'security',
            'color' => 'yellow',
            'is_pinned' => true,
        ]);

        // Mastercard notes
        $mastercard = $users->where('role', 'mastercard')->first();
        Note::create([
            'user_id' => $mastercard->id,
            'title' => 'Jadwal Rapat Kepala Sekolah',
            'content' => "Senin: 10:00 - Rapat Dewan Guru\nRabu: 14:00 - Rapat Orang Tua\nJumat: 09:00 - Evaluasi Mingguan",
            'category' => 'meeting',
            'color' => 'blue',
            'is_pinned' => true,
        ]);

        Note::create([
            'user_id' => $mastercard->id,
            'title' => 'Target Penerimaan Siswa 2025',
            'content' => "Target: 500 siswa baru\nPendaftar saat ini: 425\nSisa: 75 kuota\nDeadline: 15 Mei 2025",
            'category' => 'admission',
            'color' => 'green',
        ]);

        // Leaders notes
        $leaders = $users->where('role', 'leader')->all();
        foreach ($leaders as $i => $leader) {
            Note::create([
                'user_id' => $leader->id,
                'title' => "Rencana Proyek " . ($i + 1),
                'content' => "Phase 1: Planning & Design\nPhase 2: Development\nPhase 3: Testing\nPhase 4: Deployment\nTarget: Q" . (($i % 4) + 1) . " 2025",
                'category' => 'project',
                'color' => 'blue',
                'is_pinned' => true,
            ]);

            Note::create([
                'user_id' => $leader->id,
                'title' => "Tim Anggota Proyek " . ($i + 1),
                'content' => "- Frontend Developer: 2 orang\n- Backend Developer: 2 orang\n- QA Tester: 1 orang\n- DevOps: 1 orang",
                'category' => 'team',
                'color' => 'purple',
            ]);
        }

        // Siswa notes
        $siswa = $users->where('user_type', 'siswa')->all();
        foreach ($siswa as $i => $student) {
            Note::create([
                'user_id' => $student->id,
                'title' => "Catatan Pelajaran Hari Ini",
                'content' => "Mata pelajaran: Matematika\nTopic: Integral dan Derivatif\nTugas: Halaman 150-155\nDeadline: Besok",
                'category' => 'study',
                'color' => 'green',
                'is_pinned' => ($i % 2 === 0),
            ]);

            Note::create([
                'user_id' => $student->id,
                'title' => "PR dan Deadline",
                'content' => "1. Matematika: Senin\n2. Bahasa Inggris: Selasa\n3. Fisika: Rabu\n4. Kimia: Kamis\n5. Sejarah: Jumat",
                'category' => 'homework',
                'color' => 'yellow',
            ]);

            Note::create([
                'user_id' => $student->id,
                'title' => "Rencana Belajar Libur",
                'content' => "- Review semua materi semester 1\n- Latihan soal UAS\n- Diskusi dengan teman\n- Tanya jawab dengan guru",
                'category' => 'study',
                'color' => 'blue',
            ]);
        }

        // Orang tua notes
        $parents = $users->where('user_type', 'orang_tua')->all();
        foreach ($parents as $i => $parent) {
            Note::create([
                'user_id' => $parent->id,
                'title' => "Perkembangan Anak di Sekolah",
                'content' => "Nilai: Sangat Memuaskan\nKehadiran: 100%\nPerilaku: Baik\nUntuk ditingkatkan: Fokus saat belajar",
                'category' => 'child_progress',
                'color' => 'green',
                'is_pinned' => true,
            ]);

            Note::create([
                'user_id' => $parent->id,
                'title' => "Biaya Sekolah",
                'content' => "SPP: Bayar tanggal 1-5 setiap bulan\nUang Buku: Semester ganjil\nKegiatan Ekstrakurikuler: Opsional",
                'category' => 'finance',
                'color' => 'yellow',
            ]);
        }

        // Tester notes
        $testers = $users->where('role', 'tester')->all();
        foreach ($testers as $i => $tester) {
            Note::create([
                'user_id' => $tester->id,
                'title' => "Test Plan Sprint " . (($i % 4) + 1),
                'content' => "Features to test:\n1. User authentication\n2. Dashboard functionality\n3. Data management\n4. Report generation\n\nDeadline: End of sprint",
                'category' => 'testing',
                'color' => 'red',
                'is_pinned' => true,
            ]);

            Note::create([
                'user_id' => $tester->id,
                'title' => "Bug Tracking",
                'content' => "Critical: 0\nHigh: 2\nMedium: 5\nLow: 8\n\nTotal: 15 bugs",
                'category' => 'bugs',
                'color' => 'orange',
            ]);
        }

        // Alumni notes
        $alumni = $users->where('user_type', 'alumni')->all();
        foreach ($alumni as $i => $alumnus) {
            Note::create([
                'user_id' => $alumnus->id,
                'title' => "Portofolio Proyek",
                'content' => "1. Mobile App Development - Bandung\n2. Web Development - Jakarta\n3. Data Analytics - Yogyakarta\n4. UI/UX Design - Surabaya",
                'category' => 'portfolio',
                'color' => 'blue',
            ]);

            Note::create([
                'user_id' => $alumnus->id,
                'title' => "Target Karir 2025",
                'content' => "Target: Senior Developer\nSkill yang perlu dipelajari:\n- Advanced Architecture\n- Cloud Technology\n- DevOps Practices",
                'category' => 'career',
                'color' => 'green',
            ]);
        }
    }
}

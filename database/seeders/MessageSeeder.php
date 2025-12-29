<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $superAdmin = $users->where('role', 'superadmin')->first();
        $mastercard = $users->where('role', 'mastercard')->first();
        $leaders = $users->where('role', 'leader')->values(); // Ambil semua leaders
        $testers = $users->where('role', 'tester')->values(); // Ambil semua testers
        $siswa = $users->where('user_type', 'siswa')->values(); // Ambil semua siswa

        // Global chat messages (room_id = null for global)
        Message::create([
            'sender_id' => $superAdmin->id,
            'recipient_id' => null,
            'room_id' => null,
            'content' => 'Selamat pagi semua, sistem K-AMU sudah siap digunakan!',
            'read_at' => now(),
        ]);

        Message::create([
            'sender_id' => $mastercard->id,
            'recipient_id' => null,
            'room_id' => null,
            'content' => 'Terima kasih admin, mari kita mulai pertemuan pagi ini.',
            'read_at' => now(),
        ]);

        foreach ($leaders as $leader) {
            Message::create([
                'sender_id' => $leader->id,
                'recipient_id' => null,
                'room_id' => null,
                'content' => "Halo semuanya, saya {$leader->name} siap memulai proyek baru hari ini.",
                'read_at' => now(),
            ]);
        }

        // Private messages between users
        // Superadmin to Mastercard
        Message::create([
            'sender_id' => $superAdmin->id,
            'recipient_id' => $mastercard->id,
            'room_id' => null,
            'content' => 'Bagaimana progress penerimaan siswa baru?',
            'read_at' => now(),
        ]);

        Message::create([
            'sender_id' => $mastercard->id,
            'recipient_id' => $superAdmin->id,
            'room_id' => null,
            'content' => 'Sudah 85% selesai, tinggal finalisasi beberapa dokumen.',
            'read_at' => now(),
        ]);

        // Leaders to each other
        if ($leaders->count() >= 2) {
            $leader1 = $leaders->first();
            $leader2 = $leaders->get(1);

            Message::create([
                'sender_id' => $leader1->id,
                'recipient_id' => $leader2->id,
                'room_id' => null,
                'content' => 'Bisa diskusi tentang timeline proyek minggu depan?',
                'read_at' => now(),
            ]);

            Message::create([
                'sender_id' => $leader2->id,
                'recipient_id' => $leader1->id,
                'room_id' => null,
                'content' => 'Tentu saja, aku sudah siapkan slide presentasi.',
                'read_at' => now(),
            ]);

            Message::create([
                'sender_id' => $leader2->id,
                'recipient_id' => $leader1->id,
                'room_id' => null,
                'content' => 'Cek email ku ya untuk file lengkapnya',
            ]);
        }

        // Leader to Tester
        if ($leaders->count() > 0 && $testers->count() > 0) {
            $leader = $leaders->first();
            $tester = $testers->first();

            Message::create([
                'sender_id' => $leader->id,
                'recipient_id' => $tester->id,
                'room_id' => null,
                'content' => 'Siap untuk test fitur baru minggu ini?',
                'read_at' => now(),
            ]);

            Message::create([
                'sender_id' => $tester->id,
                'recipient_id' => $leader->id,
                'room_id' => null,
                'content' => 'Siap! Kirim saja test plan nya.',
            ]);
        }

        // Siswa to Siswa
        if ($siswa->count() >= 2) {
            $siswa1 = $siswa->first();
            $siswa2 = $siswa->get(1);

            Message::create([
                'sender_id' => $siswa1->id,
                'recipient_id' => $siswa2->id,
                'room_id' => null,
                'content' => 'Tolong bantu aku dengan PR matematika dong',
                'read_at' => now(),
            ]);

            Message::create([
                'sender_id' => $siswa2->id,
                'recipient_id' => $siswa1->id,
                'room_id' => null,
                'content' => 'Oke, besok kita belajar bersama ya di perpustakaan',
                'read_at' => now(),
            ]);
        }
    }
}

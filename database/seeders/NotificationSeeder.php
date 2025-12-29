<?php

namespace Database\Seeders;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        $notificationTypes = [
            'message' => 'Anda menerima pesan baru',
            'project_update' => 'Project diupdate',
            'bug_assigned' => 'Bug report di-assign ke Anda',
            'bug_resolved' => 'Bug report yang Anda laporkan telah diresolve',
            'test_result' => 'Test result baru tersedia',
            'user_joined' => 'User baru bergabung di proyek',
            'comment' => 'Ada komentar pada item Anda',
            'mention' => 'Anda di-mention dalam sebuah diskusi',
            'achievement' => 'Anda mendapat achievement baru',
            'deadline_reminder' => 'Reminder: Deadline proyek tinggal beberapa hari',
            'system_alert' => 'Sistem maintenance schedule',
            'new_feature' => 'Fitur baru tersedia di sistem',
        ];

        $notificationTitles = [
            'message' => [
                '{sender} mengirim pesan baru untuk Anda',
                'Ada {count} pesan baru dari {sender}',
                'Anda menerima feedback dari {sender}',
            ],
            'project_update' => [
                'Project "{project}" telah diupdate',
                'Progress project "{project}" mencapai {progress}%',
                'Tim project "{project}" menambah member baru',
            ],
            'bug_assigned' => [
                'Bug "{bug}" di-assign ke Anda',
                'Anda ditugaskan untuk fix bug severity "{severity}"',
            ],
            'bug_resolved' => [
                'Bug "{bug}" yang Anda laporkan sudah diresolve',
                'Tim telah mengatasi issue "{bug}"',
            ],
            'test_result' => [
                'Test result "{test}" telah selesai',
                'Hasil testing "{test}" menunjukkan {percentage}% passed',
            ],
            'user_joined' => [
                '{user} bergabung dengan project "{project}"',
            ],
            'comment' => [
                '{user} berkomentar pada catatan Anda',
                'Ada {count} komentar baru pada item Anda',
            ],
            'mention' => [
                '{user} menyebut Anda dalam diskusi',
            ],
            'achievement' => [
                'Selamat! Anda mendapat badge "{achievement}"',
                'Anda telah mencapai milestone "{milestone}"',
            ],
            'deadline_reminder' => [
                'Deadline project "{project}" tinggal {days} hari',
                'Reminder: Selesaikan "{task}" sebelum {date}',
            ],
            'system_alert' => [
                'Sistem akan maintenance pada {date}',
                'Update sistem berhasil dipasang',
                'Alert: Sistem performance menurun',
            ],
            'new_feature' => [
                'Fitur baru "{feature}" sudah bisa digunakan',
                'Cek fitur improvements di halaman "{page}"',
            ],
        ];

        $i = 0;
        foreach ($users as $user) {
            $notificationCount = rand(3, 12);

            for ($j = 0; $j < $notificationCount; $j++) {
                $typeKey = array_rand($notificationTypes);
                $type = $notificationTypes[$typeKey];

                // Generate title from template
                $titleTemplates = $notificationTitles[$typeKey] ?? [$type];
                $title = $titleTemplates[array_rand($titleTemplates)];

                // Replace placeholders
                $title = str_replace(
                    ['{sender}', '{user}', '{project}', '{bug}', '{test}', '{feature}', '{page}'],
                    [
                        User::where('id', '!=', $user->id)->first()?->name ?? 'System',
                        User::where('id', '!=', $user->id)->first()?->name ?? 'Member',
                        'Sistem Akademik v' . rand(1, 3),
                        'Login Form Issue',
                        'Authentication Test',
                        'Real-time Chat',
                        'Dashboard',
                    ],
                    $title
                );

                $isRead = rand(0, 100) > 40; // 60% unread, 40% read

                Notification::create([
                    'user_id' => $user->id,
                    'type' => $typeKey,
                    'title' => $title,
                    'content' => $type,
                    'icon' => 'bell',
                    'action_url' => '/dashboard',
                    'read_at' => $isRead ? now()->subDays(rand(0, 20)) : null,
                    'created_at' => now()->subDays(rand(0, 30))->subHours(rand(0, 23)),
                ]);

                $i++;
            }
        }

        // Add some high-priority notifications for users
        $leaders = User::where('role', 'leader')->get();
        foreach ($leaders as $leader) {
            Notification::create([
                'user_id' => $leader->id,
                'type' => 'deadline_reminder',
                'title' => 'URGENT: Project deadline tinggal 3 hari!',
                'content' => 'Reminder: Deadline proyek tinggal beberapa hari',
                'icon' => 'clock',
                'action_url' => '/leader/proyek',
                'read_at' => null,
                'created_at' => now()->subHours(rand(1, 24)),
            ]);
        }

        // Notification untuk tester
        $testers = User::where('role', 'tester')->get();
        foreach ($testers as $tester) {
            Notification::create([
                'user_id' => $tester->id,
                'type' => 'bug_assigned',
                'title' => 'Critical Bug: API endpoint authentication bypass',
                'content' => 'Bug report di-assign ke Anda',
                'icon' => 'bug',
                'action_url' => '/tester/bug',
                'read_at' => null,
                'created_at' => now()->subHours(2),
            ]);
        }

        // Notification untuk siswa
        $siswa = User::where('user_type', 'siswa')->get();
        foreach ($siswa as $student) {
            Notification::create([
                'user_id' => $student->id,
                'type' => 'achievement',
                'title' => 'Congratulations! Anda mendapat badge "Fast Learner"',
                'content' => 'Selamat! Anda mendapat badge baru',
                'icon' => 'star',
                'action_url' => '/dashboard',
                'read_at' => now()->subDays(5),
                'created_at' => now()->subDays(5),
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leaders = User::where('role', 'leader')->get();
        $testers = User::where('role', 'tester')->pluck('id')->toArray();
        $developers = User::where('role', '!=', 'superadmin')
            ->where('role', '!=', 'mastercard')
            ->where('role', '!=', 'leader')
            ->limit(6)
            ->pluck('id')
            ->toArray();

        $projectStatuses = ['planning', 'in_progress', 'completed', 'on_hold'];
        $i = 0;

        foreach ($leaders as $leader) {
            // Project 1 for this leader
            Project::create([
                'leader_id' => $leader->id,
                'name' => 'Sistem Informasi Akademik ' . ($i + 1),
                'description' => 'Mengembangkan sistem informasi akademik yang terintegrasi dengan portal siswa dan orang tua untuk memudahkan proses monitoring nilai dan kehadiran.',
                'status' => $projectStatuses[$i % 4],
                'progress' => ($i % 4 === 0 ? 0 : ($i % 4 === 1 ? 65 : ($i % 4 === 2 ? 100 : 30))),
                'team_members' => json_encode(array_slice($developers, 0, 3)),
                'start_date' => now()->subMonths(6 - $i),
                'end_date' => now()->addMonths(6 - $i),
            ]);

            // Project 2 for this leader
            Project::create([
                'leader_id' => $leader->id,
                'name' => 'Platform E-Learning ' . ($i + 1),
                'description' => 'Membuat platform e-learning interaktif dengan fitur video streaming, kuis online, dan tracking progress siswa secara real-time untuk mendukung pembelajaran jarak jauh.',
                'status' => $projectStatuses[($i + 1) % 4],
                'progress' => (($i + 1) % 4 === 0 ? 25 : (($i + 1) % 4 === 1 ? 75 : (($i + 1) % 4 === 2 ? 100 : 45))),
                'team_members' => json_encode(array_slice($developers, 2, 3)),
                'start_date' => now()->subMonths(4 - $i),
                'end_date' => now()->addMonths(8 - $i),
            ]);

            // Project 3 for this leader
            Project::create([
                'leader_id' => $leader->id,
                'name' => 'Mobile App Presensi ' . ($i + 1),
                'description' => 'Aplikasi mobile untuk sistem presensi digital dengan fitur geolocation dan integrasi dengan sistem akademik untuk meningkatkan akurasi dan efisiensi.',
                'status' => $projectStatuses[($i + 2) % 4],
                'progress' => (($i + 2) % 4 === 0 ? 50 : (($i + 2) % 4 === 1 ? 85 : (($i + 2) % 4 === 2 ? 100 : 20))),
                'team_members' => json_encode(array_slice($developers, 4, 2)),
                'start_date' => now()->subMonths(3 - $i),
                'end_date' => now()->addMonths(9 - $i),
            ]);

            $i++;
        }
    }
}

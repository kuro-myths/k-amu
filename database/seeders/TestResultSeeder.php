<?php

namespace Database\Seeders;

use App\Models\TestResult;
use App\Models\User;
use Illuminate\Database\Seeder;

class TestResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testers = User::where('role', 'tester')->get();

        $testStatuses = ['in_progress', 'passed', 'failed', 'inconclusive'];

        $testCaseSamples = [
            json_encode([
                ['id' => 1, 'name' => 'User dapat login dengan credential yang benar', 'result' => 'passed'],
                ['id' => 2, 'name' => 'User tidak dapat login dengan password salah', 'result' => 'passed'],
                ['id' => 3, 'name' => 'Sistem menampilkan error message yang jelas', 'result' => 'passed'],
            ]),
            json_encode([
                ['id' => 1, 'name' => 'Dashboard memuat dalam waktu < 2 detik', 'result' => 'passed'],
                ['id' => 2, 'name' => 'Semua chart dan grafik menampilkan data dengan benar', 'result' => 'failed'],
                ['id' => 3, 'name' => 'Export data berfungsi dengan sempurna', 'result' => 'passed'],
                ['id' => 4, 'name' => 'Responsive design berfungsi pada semua device', 'result' => 'inconclusive'],
            ]),
            json_encode([
                ['id' => 1, 'name' => 'User dapat membuat catatan baru', 'result' => 'passed'],
                ['id' => 2, 'name' => 'User dapat edit catatan milik sendiri', 'result' => 'passed'],
                ['id' => 3, 'name' => 'User tidak dapat edit catatan milik orang lain', 'result' => 'passed'],
                ['id' => 4, 'name' => 'Delete catatan meminta konfirmasi', 'result' => 'passed'],
                ['id' => 5, 'name' => 'Pin catatan berfungsi dengan baik', 'result' => 'failed'],
            ]),
            json_encode([
                ['id' => 1, 'name' => 'Chat global dapat diakses semua user', 'result' => 'passed'],
                ['id' => 2, 'name' => 'Private chat hanya terlihat untuk sender dan recipient', 'result' => 'passed'],
                ['id' => 3, 'name' => 'Message history tersimpan dengan benar', 'result' => 'passed'],
                ['id' => 4, 'name' => 'Real-time notification berfungsi', 'result' => 'inconclusive'],
                ['id' => 5, 'name' => 'File sharing dalam chat berfungsi', 'result' => 'failed'],
                ['id' => 6, 'name' => 'Search pesan berfungsi dengan cepat', 'result' => 'passed'],
            ]),
            json_encode([
                ['id' => 1, 'name' => 'Leader dapat membuat project baru', 'result' => 'passed'],
                ['id' => 2, 'name' => 'Leader dapat menambah team member', 'result' => 'passed'],
                ['id' => 3, 'name' => 'Progress tracking akurat', 'result' => 'passed'],
                ['id' => 4, 'name' => 'Team member menerima notifikasi', 'result' => 'inconclusive'],
                ['id' => 5, 'name' => 'Deadline reminders berfungsi', 'result' => 'failed'],
            ]),
            json_encode([
                ['id' => 1, 'name' => 'User dapat submit bug report', 'result' => 'passed'],
                ['id' => 2, 'name' => 'Tester dapat assign bug ke developer', 'result' => 'passed'],
                ['id' => 3, 'name' => 'Status tracking (open-in progress-resolved)', 'result' => 'passed'],
                ['id' => 4, 'name' => 'Severity levels terdefinisi dengan jelas', 'result' => 'passed'],
                ['id' => 5, 'name' => 'File attachment untuk bug berfungsi', 'result' => 'inconclusive'],
                ['id' => 6, 'name' => 'Notifikasi ketika bug di-assign', 'result' => 'failed'],
            ]),
        ];

        $testDescriptions = [
            'Testing authentication dan session management',
            'Testing dashboard dan analytics features',
            'Testing note management functionality',
            'Testing chat dan messaging system',
            'Testing project management dan collaboration',
            'Testing bug tracking dan reporting system',
        ];

        $i = 0;
        foreach ($testers as $tester) {
            for ($j = 0; $j < 2; $j++) {
                $testIndex = ($i + $j) % count($testCaseSamples);
                $status = $testStatuses[$testIndex % count($testStatuses)];

                TestResult::create([
                    'tester_id' => $tester->id,
                    'feature_name' => 'Sprint ' . (($j + 1)) . ' - ' . $testDescriptions[$testIndex],
                    'test_description' => $testDescriptions[$testIndex],
                    'test_cases' => $testCaseSamples[$testIndex],
                    'status' => $status,
                    'percentage' => rand(0, 100),
                    'notes' => 'Test hasil untuk fitur ' . $testDescriptions[$testIndex],
                    'environment' => json_encode([
                        'browser' => 'Chrome',
                        'os' => 'Windows 10',
                        'version' => '1.0.0',
                    ]),
                ]);
            }

            $i += 2;
        }

        // Add detailed test for critical features
        TestResult::create([
            'tester_id' => $testers->first()->id,
            'feature_name' => 'Security & Penetration Testing',
            'test_description' => 'Testing security vulnerabilities dan penetration testing',
            'test_cases' => json_encode([
                ['id' => 1, 'name' => 'SQL Injection vulnerability check', 'result' => 'passed'],
                ['id' => 2, 'name' => 'XSS vulnerability check', 'result' => 'passed'],
                ['id' => 3, 'name' => 'CSRF protection verification', 'result' => 'passed'],
                ['id' => 4, 'name' => 'Authentication bypass attempt', 'result' => 'failed'],
                ['id' => 5, 'name' => 'Authorization bypass check', 'result' => 'passed'],
            ]),
            'status' => 'failed',
            'percentage' => 80.0,
            'notes' => 'Security testing menunjukkan 1 vulnerability yang perlu fixed',
            'environment' => json_encode([
                'browser' => 'Chrome',
                'os' => 'Linux',
                'version' => '1.0.0',
            ]),
        ]);

        // Add performance testing
        TestResult::create([
            'tester_id' => $testers->get(1)?->id ?? $testers->first()->id,
            'feature_name' => 'Performance & Load Testing',
            'test_description' => 'Testing performance dan load testing untuk sistem',
            'test_cases' => json_encode([
                ['id' => 1, 'name' => 'Homepage load time < 2 seconds', 'result' => 'passed'],
                ['id' => 2, 'name' => 'API response time < 500ms', 'result' => 'passed'],
                ['id' => 3, 'name' => 'Handle 1000 concurrent users', 'result' => 'inconclusive'],
                ['id' => 4, 'name' => 'Database query optimization', 'result' => 'failed'],
                ['id' => 5, 'name' => 'Memory leak check', 'result' => 'inconclusive'],
            ]),
            'status' => 'inconclusive',
            'percentage' => 40.0,
            'notes' => 'Performance testing masih in progress, ada beberapa bottleneck yang ditemukan',
            'environment' => json_encode([
                'browser' => 'Chrome',
                'os' => 'Windows Server 2019',
                'version' => '1.0.0',
            ]),
        ]);
    }
}

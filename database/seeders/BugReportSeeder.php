<?php

namespace Database\Seeders;

use App\Models\BugReport;
use App\Models\User;
use Illuminate\Database\Seeder;

class BugReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reporters = User::where('role', '!=', 'superadmin')
            ->where('role', '!=', 'mastercard')
            ->limit(5)
            ->get();

        $testers = User::where('role', 'tester')->get();
        $superAdmin = User::where('role', 'superadmin')->first();

        $severities = ['low', 'medium', 'high', 'critical'];
        $statuses = ['open', 'in_progress', 'resolved', 'closed', 'reopened'];

        $bugTemplates = [
            [
                'title' => 'Login form tidak responsif pada mobile',
                'description' => 'Ketika mengakses halaman login dari perangkat mobile, form tidak menampilkan dengan baik. Input field terpotong dan tombol login tidak terlihat jelas.',
            ],
            [
                'title' => 'Database connection timeout',
                'description' => 'Saat jam-jam sibuk, koneksi database sering timeout menyebabkan aplikasi loading lama atau error. Perlu optimization query atau upgrade server resources.',
            ],
            [
                'title' => 'Export data ke Excel error',
                'description' => 'Fitur export data ke file Excel sering gagal dengan error message yang tidak jelas. User tidak tahu apa yang salah dengan data mereka.',
            ],
            [
                'title' => 'Notifikasi real-time tidak berfungsi',
                'description' => 'Notifikasi push untuk user tidak masuk dalam waktu real-time. Ada delay hingga beberapa menit sebelum notifikasi muncul.',
            ],
            [
                'title' => 'Search functionality lambat',
                'description' => 'Fitur search pada data dengan lebih dari 10000 records sangat lambat. Perlu index database atau implementasi full-text search.',
            ],
            [
                'title' => 'File upload size limit tidak jelas',
                'description' => 'User tidak tahu ada batasan ukuran file untuk upload. Upload file besar langsung error tanpa pesan penjelasan yang baik.',
            ],
            [
                'title' => 'Sorting dan filtering tidak bekerja bersamaan',
                'description' => 'Ketika user menambahkan filter, sorting yang sebelumnya diaplikasikan hilang. Perlu sinkronisasi kedua fitur ini.',
            ],
            [
                'title' => 'Memory leak pada background job',
                'description' => 'Proses background job (queue) menggunakan memory yang terus bertambah. Setelah beberapa jam, server menjadi lambat.',
            ],
            [
                'title' => 'Timezone issue pada timestamp',
                'description' => 'Timestamp yang ditampilkan tidak sesuai dengan timezone user. Ada selisih waktu beberapa jam.',
            ],
            [
                'title' => 'Permission denied untuk download file',
                'description' => 'User dengan role tertentu tidak bisa download file meskipun sudah memiliki permission. Ada bug pada logic check permission.',
            ],
        ];

        foreach ($bugTemplates as $index => $template) {
            $reporter = $reporters->random();
            $assignedTo = ($index % 2 === 0) ? $testers->random() : null;
            $status = $statuses[$index % count($statuses)];

            $bug = BugReport::create([
                'reporter_id' => $reporter->id,
                'assigned_to' => $assignedTo?->id,
                'title' => $template['title'],
                'description' => $template['description'],
                'severity' => $severities[$index % count($severities)],
                'status' => $status,
                'attachments' => json_encode([
                    'screenshot_' . ($index + 1) . '.png',
                    'error_log_' . ($index + 1) . '.txt',
                ]),
                'created_at' => now()->subDays(rand(1, 30)),
            ]);

            // Add resolved timestamp untuk yang resolved/closed
            if (in_array($status, ['resolved', 'closed'])) {
                $bug->update([
                    'resolved_at' => $bug->created_at->addDays(rand(1, 5)),
                ]);
            } elseif ($status === 'in_progress') {
                // Set resolved_at dengan nilai null untuk yang in_progress
                $bug->update([
                    'resolved_at' => null,
                ]);
            }
        }

        // Add additional critical bugs
        BugReport::create([
            'reporter_id' => $reporters->random()->id,
            'assigned_to' => $testers->first()?->id,
            'title' => 'API endpoint authentication bypass',
            'description' => 'Security issue: Beberapa API endpoint dapat diakses tanpa token valid. Ini membahayakan data user. URGENT!',
            'severity' => 'critical',
            'status' => 'in_progress',
            'attachments' => json_encode(['security_report.pdf']),
            'created_at' => now()->subDays(2),
        ]);

        BugReport::create([
            'reporter_id' => $superAdmin->id,
            'assigned_to' => $testers->first()?->id,
            'title' => 'Data integrity issue pada financial records',
            'description' => 'Database check menemukan inconsistency pada data finansial. Amount di table transactions tidak match dengan summary. Critical untuk audit!',
            'severity' => 'critical',
            'status' => 'in_progress',
            'attachments' => json_encode(['audit_log.csv', 'discrepancy_report.xlsx']),
            'created_at' => now()->subDays(1),
        ]);
    }
}

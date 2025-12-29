<?php

namespace Database\Seeders;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Database\Seeder;

class ActivityLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        $actions = [
            'login' => 'User melakukan login',
            'logout' => 'User melakukan logout',
            'create_note' => 'User membuat catatan baru',
            'update_note' => 'User mengupdate catatan',
            'delete_note' => 'User menghapus catatan',
            'send_message' => 'User mengirim pesan',
            'create_project' => 'User membuat project baru',
            'update_project' => 'User mengupdate project',
            'create_bug' => 'User membuat bug report',
            'update_bug' => 'User mengupdate bug report',
            'create_test' => 'User membuat test result',
            'update_test' => 'User mengupdate test result',
            'change_password' => 'User mengubah password',
            'update_profile' => 'User mengupdate profile',
            'export_data' => 'User melakukan export data',
            'import_data' => 'User melakukan import data',
            'system_config' => 'Admin mengubah konfigurasi sistem',
            'user_management' => 'Admin mengelola user',
        ];

        $models = [
            'User',
            'Note',
            'Message',
            'Project',
            'BugReport',
            'TestResult',
            'SystemSetting',
            'ActivityLog',
        ];

        // Generate activity logs for each user
        foreach ($users as $user) {
            for ($i = 0; $i < rand(5, 15); $i++) {
                $actionKey = array_rand($actions);
                $model = $models[array_rand($models)];

                $oldValues = null;
                $newValues = null;

                // Add sample old/new values untuk update actions
                if (strpos($actionKey, 'update') !== false) {
                    $oldValues = json_encode(['status' => 'draft', 'title' => 'Old Title']);
                    $newValues = json_encode(['status' => 'published', 'title' => 'Updated Title']);
                } elseif (strpos($actionKey, 'create') !== false) {
                    $newValues = json_encode(['id' => rand(1, 100), 'name' => 'New Item']);
                } elseif ($actionKey === 'change_password') {
                    $oldValues = json_encode(['password_hash' => 'xxxxx']);
                    $newValues = json_encode(['password_hash' => 'yyyyy']);
                }

                ActivityLog::create([
                    'user_id' => $user->id,
                    'action' => $actionKey,
                    'model' => $model,
                    'model_id' => rand(1, 100),
                    'old_values' => $oldValues,
                    'new_values' => $newValues,
                    'ip_address' => fake()->ipv4(),
                    'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                    'created_at' => now()->subDays(rand(0, 30))->subHours(rand(0, 23)),
                ]);
            }
        }

        // Add some specific high-profile actions
        $superAdmin = User::where('role', 'superadmin')->first();

        ActivityLog::create([
            'user_id' => $superAdmin->id,
            'action' => 'system_config',
            'model' => 'SystemSetting',
            'model_id' => 1,
            'old_values' => json_encode(['maintenance_mode' => false, 'max_users' => 500]),
            'new_values' => json_encode(['maintenance_mode' => true, 'max_users' => 1000]),
            'ip_address' => '192.168.1.1',
            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
            'created_at' => now()->subDays(5),
        ]);

        ActivityLog::create([
            'user_id' => $superAdmin->id,
            'action' => 'user_management',
            'model' => 'User',
            'model_id' => 1,
            'old_values' => json_encode(['role' => 'user', 'status' => 'active']),
            'new_values' => json_encode(['role' => 'leader', 'status' => 'active']),
            'ip_address' => '192.168.1.1',
            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
            'created_at' => now()->subDays(3),
        ]);

        // Mastercard activity
        $mastercard = User::where('role', 'mastercard')->first();

        ActivityLog::create([
            'user_id' => $mastercard->id,
            'action' => 'user_management',
            'model' => 'User',
            'model_id' => null,
            'old_values' => null,
            'new_values' => json_encode(['name' => 'Siswa Baru', 'email' => 'siswa_baru@k-amu.test', 'role' => 'user']),
            'ip_address' => '192.168.1.50',
            'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7)',
            'created_at' => now()->subDays(2),
        ]);
    }
}

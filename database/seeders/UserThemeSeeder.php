<?php

namespace Database\Seeders;

use App\Models\UserTheme;
use App\Models\SearchHistory;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default theme for existing users
        $users = User::all();

        foreach ($users as $user) {
            UserTheme::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'mode' => 'normal',
                    'primary_color' => '#3b82f6',
                    'secondary_color' => '#8b5cf6',
                    'background_color' => '#ffffff',
                    'text_color' => '#000000',
                    'accent_color' => '#ec4899',
                    'font_family' => 'sans',
                    'font_size' => 'normal',
                    'font_weight' => 'normal',
                    'dark_mode' => false,
                    'compact_mode' => false,
                ]
            );
        }
    }
}

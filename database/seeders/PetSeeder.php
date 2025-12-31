<?php

namespace Database\Seeders;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        $defaultNames = [
            'user' => ['Max', 'Bella', 'Charlie', 'Luna', 'Rocky'],
            'leader' => ['Phoenix', 'Storm', 'Titan', 'Eagle', 'Lion'],
            'mastercard' => ['Sphinx', 'Atlas', 'Oracle', 'Sage', 'Wizard'],
            'tester' => ['Scout', 'Hunter', 'Tracker', 'Ranger', 'Detective'],
            'superadmin' => ['Kai-Myu', 'Emperor', 'Sovereign', 'Master', 'Guardian'],
        ];

        foreach ($users as $user) {
            if (!$user->pet) {
                $role = $user->role ?? 'user';
                $names = $defaultNames[$role] ?? $defaultNames['user'];
                $petName = $names[array_rand($names)];

                Pet::create([
                    'user_id' => $user->id,
                    'name' => $petName,
                    'pet_type' => 'vtuber',
                    'role_type' => $role,
                    'level' => 1,
                    'experience' => 0,
                    'health' => 100,
                    'happiness' => 100,
                    'energy' => 100,
                    'biography' => "Pet assistant untuk {$role} yang loyal dan berdedikasi.",
                    'stats' => [
                        'charm' => rand(80, 100),
                        'popularity' => rand(75, 95),
                        'knowledge' => rand(70, 90),
                        'sparkle' => rand(80, 100),
                    ],
                    'abilities' => [
                        'Loyal',
                        'Smart',
                        'Friendly',
                        'Helpful',
                        'Reliable',
                    ],
                ]);
            }
        }
    }
}

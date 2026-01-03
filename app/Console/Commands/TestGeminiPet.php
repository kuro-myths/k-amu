<?php

namespace App\Console\Commands;

use App\Services\GeminiPetService;
use Illuminate\Console\Command;

class TestGeminiPet extends Command
{
    protected $signature = 'test:gemini-pet';
    protected $description = 'Test Gemini AI Pet integration';

    public function handle()
    {
        $this->info('🤖 Testing Gemini Pet AI Integration...\n');

        // Initialize service
        $geminiService = new GeminiPetService();

        // Test data
        $petInfo = [
            'name' => 'Kai-Myu',
            'pet_type' => 'vtuber',
            'role_type' => 'superadmin',
            'biography' => 'A sophisticated AI pet assistant',
            'stats' => [
                'knowledge' => 95,
                'charm' => 88,
                'popularity' => 92,
                'sparkle' => 85,
            ],
            'level' => 5,
            'experience' => 45,
        ];

        // Test 1: Chat functionality
        $this->info('Test 1: Chat Functionality');
        $this->line('Question: Siapa kamu dan apa keahlianmu?');

        $result = $geminiService->chatWithPet(
            'Siapa kamu dan apa keahlianmu?',
            $petInfo
        );

        if ($result['success']) {
            $this->info('✅ Chat Response: ' . $result['response']);
        } else {
            $this->error('❌ Chat failed: ' . ($result['error'] ?? 'Unknown error'));
        }

        $this->newLine();

        // Test 2: Motivation
        $this->info('Test 2: Motivation Generation');
        $motivation = $geminiService->generateMotivation($petInfo);
        $this->info('✅ Motivation: ' . $motivation);

        $this->newLine();

        // Test 3: Learning Tips
        $this->info('Test 3: Learning Tip Generation');
        $tip = $geminiService->generateLearningTip($petInfo);
        $this->info('✅ Learning Tip: ' . $tip);

        $this->newLine();
        $this->info('✨ All tests completed!');
    }
}

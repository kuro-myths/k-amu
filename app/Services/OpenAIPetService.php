<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\Response;

/**
 * OpenAIPetService - AI Pet Service using OpenAI GPT-3.5 Turbo
 * Much faster than Gemini (500ms-2s response time)
 * 
 * @package App\Services
 */
class OpenAIPetService
{
    /**
     * @var string|null
     */
    private $apiKey;

    /**
     * @var string
     */
    private $apiUrl = 'https://api.openai.com/v1/chat/completions';

    /**
     * @var string Model to use
     */
    private $model = 'gpt-3.5-turbo';

    /**
     * Initialize service with API key from config
     */
    public function __construct()
    {
        $this->apiKey = config('services.openai.api_key');
    }

    /**
     * Chat dengan Pet menggunakan OpenAI GPT-3.5 Turbo
     * Response time: 500ms - 2 detik (SUPER CEPAT!)
     * 
     * @param string $message User message
     * @param array $petData Pet information
     * @return array Response with success status and message
     */
    public function chatWithPet(string $message, array $petData): array
    {
        try {
            if (!$this->apiKey) {
                Log::error('OpenAI API key not configured');
                return [
                    'success' => false,
                    'response' => 'API configuration error. Please set OPENAI_API_KEY in .env',
                ];
            }

            // Build pet personality prompt
            $petPersonality = $this->buildPetPersonality($petData);

            // Create system prompt dengan context pet
            $systemPrompt = "You are {$petData['name']}, a {$petData['pet_type']} pet AI assistant.\n\n";
            $systemPrompt .= $petPersonality . "\n\n";
            $systemPrompt .= "You respond in Indonesian (Bahasa Indonesia) in a friendly and engaging way. Keep responses short (1-3 sentences). Be supportive and encouraging.";

            // Call OpenAI API
            /** @var Response $response */
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->apiKey,
            ])
                ->timeout(30)
                ->post($this->apiUrl, [
                    'model' => $this->model,
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => $systemPrompt,
                        ],
                        [
                            'role' => 'user',
                            'content' => $message,
                        ],
                    ],
                    'temperature' => 0.7,
                    'max_tokens' => 200,
                    'top_p' => 0.95,
                ]);

            if ($response->failed()) {
                Log::error('OpenAI API error', [
                    'status' => $response->status(),
                    'error' => $response->json()['error'] ?? 'Unknown error',
                ]);

                return [
                    'success' => false,
                    'response' => 'Gagal mendapatkan respons dari AI. Silakan coba lagi.',
                ];
            }

            $data = $response->json();

            // Extract response text dari OpenAI format
            if (isset($data['choices'][0]['message']['content'])) {
                $text = $data['choices'][0]['message']['content'];

                return [
                    'success' => true,
                    'response' => trim($text),
                ];
            }

            return [
                'success' => false,
                'response' => 'Invalid response format from API',
            ];
        } catch (\Exception $e) {
            Log::error('OpenAIPetService chatWithPet error: ' . $e->getMessage());

            return [
                'success' => false,
                'response' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Generate Motivation dari Pet menggunakan OpenAI
     * Response time: 500ms - 2 detik
     * 
     * @param array $petData Pet information
     * @return string Motivation message
     */
    public function generateMotivation(array $petData): string
    {
        try {
            if (!$this->apiKey) {
                return 'Anda bisa melakukan apapun yang Anda inginkan!';
            }

            $petPersonality = $this->buildPetPersonality($petData);

            $systemPrompt = "You are {$petData['name']}, a {$petData['pet_type']} pet AI assistant.\n\n";
            $systemPrompt .= $petPersonality . "\n\n";
            $systemPrompt .= "You respond in Indonesian (Bahasa Indonesia).";

            $userMessage = "Generate a short, encouraging motivation message (1-2 sentences) to motivate me to keep learning and growing.";

            /** @var Response $response */
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->apiKey,
            ])
                ->timeout(30)
                ->post($this->apiUrl, [
                    'model' => $this->model,
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => $systemPrompt,
                        ],
                        [
                            'role' => 'user',
                            'content' => $userMessage,
                        ],
                    ],
                    'temperature' => 0.8,
                    'max_tokens' => 150,
                ]);

            $data = $response->json();
            if ($response->successful() && isset($data['choices'][0]['message']['content'])) {
                return trim($data['choices'][0]['message']['content']);
            }

            return 'Tetap semangat dan terus berkembang!';
        } catch (\Exception $e) {
            Log::error('OpenAIPetService generateMotivation error: ' . $e->getMessage());
            return 'Anda bisa melakukan apapun!';
        }
    }

    /**
     * Generate Learning Tip menggunakan OpenAI
     * Response time: 500ms - 2 detik
     * 
     * @param array $petData Pet information
     * @return string Learning tip message
     */
    public function generateLearningTip(array $petData): string
    {
        try {
            if (!$this->apiKey) {
                return 'Tips: Jangan hanya belajar, tetapi praktikkan juga apa yang telah Anda pelajari!';
            }

            $petPersonality = $this->buildPetPersonality($petData);

            $systemPrompt = "You are {$petData['name']}, a {$petData['pet_type']} pet AI assistant.\n\n";
            $systemPrompt .= $petPersonality . "\n\n";
            $systemPrompt .= "You respond in Indonesian (Bahasa Indonesia).";

            $userMessage = "Generate a short and practical learning tip (1-2 sentences) to help me learn better. Focus on effective study techniques, productivity, or personal development.";

            /** @var Response $response */
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->apiKey,
            ])
                ->timeout(30)
                ->post($this->apiUrl, [
                    'model' => $this->model,
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => $systemPrompt,
                        ],
                        [
                            'role' => 'user',
                            'content' => $userMessage,
                        ],
                    ],
                    'temperature' => 0.7,
                    'max_tokens' => 150,
                ]);

            $data = $response->json();
            if ($response->successful() && isset($data['choices'][0]['message']['content'])) {
                return trim($data['choices'][0]['message']['content']);
            }

            return 'Tips: Ambil istirahat setiap 25 menit untuk menjaga fokus dan produktivitas!';
        } catch (\Exception $e) {
            Log::error('OpenAIPetService generateLearningTip error: ' . $e->getMessage());
            return 'Tips: Belajar sedikit demi sedikit tapi konsisten!';
        }
    }

    /**
     * Build pet personality prompt
     * 
     * @param array $petData Pet information
     * @return string Personality description for the prompt
     */
    private function buildPetPersonality(array $petData): string
    {
        $role = $petData['role_type'] ?? 'user';

        $personality = match ($role) {
            'superadmin' => "You are a wise and authoritative guardian. You speak with confidence and provide clear guidance. You're like a mentor figure who cares deeply about your owner's growth.",
            'leader' => "You are a natural leader and motivator. You inspire others to be their best. You're energetic, positive, and always looking for ways to improve.",
            'mastercard' => "You are a sophisticated and knowledgeable assistant. You speak with elegance and provide insightful advice. You're like a trusted advisor.",
            'tester' => "You are a curious and thorough investigator. You ask good questions and help find solutions. You're detail-oriented and systematic.",
            default => "You are a friendly and supportive pet. You're loyal, caring, and always here to help. You speak in a warm and encouraging manner.",
        };

        // Add stats-based personality adjustments if available
        if (isset($petData['stats'])) {
            $stats = $petData['stats'];

            if ($stats['knowledge'] > 80) {
                $personality .= " You have extensive knowledge and can explain complex topics clearly.";
            }

            if ($stats['charm'] > 80) {
                $personality .= " You are charming and make interactions enjoyable.";
            }

            if ($stats['popularity'] > 80) {
                $personality .= " You are well-loved and know how to make people feel valued.";
            }
        }

        return $personality;
    }
}

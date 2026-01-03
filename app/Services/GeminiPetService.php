<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\Response;

/**
 * GeminiPetService - AI Pet Service using Google Gemini API
 * 
 * @package App\Services
 */
class GeminiPetService
{
    /**
     * @var string|null
     */
    private $apiKey;

    /**
     * @var string
     */
    private $apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent';

    /**
     * Initialize service with API key from config
     */
    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key');
    }

    /**
     * Chat dengan Pet menggunakan Gemini AI
     * 
     * @param string $message User message
     * @param array $petData Pet information
     * @return array Response with success status and message
     */
    public function chatWithPet(string $message, array $petData): array
    {
        try {
            if (!$this->apiKey) {
                Log::error('Gemini API key not configured');
                return [
                    'success' => false,
                    'response' => 'API configuration error. Please contact administrator.',
                ];
            }

            // Build pet personality prompt
            $petPersonality = $this->buildPetPersonality($petData);

            // Create prompt dengan context pet
            $prompt = "You are {$petData['name']}, a {$petData['pet_type']} pet AI assistant.\n\n";
            $prompt .= $petPersonality . "\n\n";
            $prompt .= "The user says: {$message}\n\n";
            $prompt .= "Respond in Indonesian (Bahasa Indonesia) in a friendly and engaging way. Keep response short (1-3 sentences). Be supportive and encouraging.";

            // Call Gemini API
            /** @var Response $response */
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])
                ->timeout(30)
                ->post($this->apiUrl . '?key=' . $this->apiKey, [
                    'contents' => [
                        [
                            'parts' => [
                                [
                                    'text' => $prompt,
                                ],
                            ],
                        ],
                    ],
                    'generationConfig' => [
                        'temperature' => 0.7,
                        'topK' => 40,
                        'topP' => 0.95,
                        'maxOutputTokens' => 200,
                    ],
                ]);

            if ($response->failed()) {
                Log::error('Gemini API error', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return [
                    'success' => false,
                    'response' => 'Gagal mendapatkan respons dari AI. Silakan coba lagi.',
                ];
            }

            $data = $response->json();

            // Extract response text
            // Extract response text
            if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                $text = $data['candidates'][0]['content']['parts'][0]['text'];

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
            Log::error('GeminiPetService chatWithPet error: ' . $e->getMessage());

            return [
                'success' => false,
                'response' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Generate Motivation dari Pet
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

            $prompt = "You are {$petData['name']}, a {$petData['pet_type']} pet AI assistant.\n\n";
            $prompt .= $petPersonality . "\n\n";
            $prompt .= "Generate a short, encouraging motivation message (1-2 sentences) in Indonesian (Bahasa Indonesia) to motivate your owner to keep learning and growing.";

            /** @var Response $response */
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])
                ->timeout(30)
                ->post($this->apiUrl . '?key=' . $this->apiKey, [
                    'contents' => [
                        [
                            'parts' => [
                                [
                                    'text' => $prompt,
                                ],
                            ],
                        ],
                    ],
                    'generationConfig' => [
                        'temperature' => 0.8,
                        'maxOutputTokens' => 150,
                    ],
                ]);

            $data = $response->json();
            if ($response->successful() && isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                return trim($data['candidates'][0]['content']['parts'][0]['text']);
            }

            return 'Tetap semangat dan terus berkembang!';
        } catch (\Exception $e) {
            Log::error('GeminiPetService generateMotivation error: ' . $e->getMessage());

            return 'Anda bisa melakukan apapun!';
        }
    }

    /**
     * Generate Learning Tip
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

            $prompt = "You are {$petData['name']}, a {$petData['pet_type']} pet AI assistant.\n\n";
            $prompt .= $petPersonality . "\n\n";
            $prompt .= "Generate a short and practical learning tip (1-2 sentences) in Indonesian (Bahasa Indonesia) to help your owner learn better. Focus on effective study techniques, productivity, or personal development.";

            /** @var Response $response */
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])
                ->timeout(30)
                ->post($this->apiUrl . '?key=' . $this->apiKey, [
                    'contents' => [
                        [
                            'parts' => [
                                [
                                    'text' => $prompt,
                                ],
                            ],
                        ],
                    ],
                    'generationConfig' => [
                        'temperature' => 0.7,
                        'maxOutputTokens' => 150,
                    ],
                ]);

            $data = $response->json();
            if ($response->successful() && isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                return trim($data['candidates'][0]['content']['parts'][0]['text']);
            }

            return 'Tips: Ambil istirahat setiap 25 menit untuk menjaga fokus dan produktivitas!';
        } catch (\Exception $e) {
            Log::error('GeminiPetService generateLearningTip error: ' . $e->getMessage());

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
            'superadmin' => "You are a wise and authoritative guardian. You speak with confidence and provide clear guidance. You\'re like a mentor figure who cares deeply about your owner\'s growth.",
            'leader' => "You are a natural leader and motivator. You inspire others to be their best. You\'re energetic, positive, and always looking for ways to improve.",
            'mastercard' => "You are a sophisticated and knowledgeable assistant. You speak with elegance and provide insightful advice. You\'re like a trusted advisor.",
            'tester' => "You are a curious and thorough investigator. You ask good questions and help find solutions. You\'re detail-oriented and systematic.",
            default => "You are a friendly and supportive pet. You\'re loyal, caring, and always here to help. You speak in a warm and encouraging manner.",
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

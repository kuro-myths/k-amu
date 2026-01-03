<?php

namespace App\Services;

/**
 * PetAIServiceFactory - Auto-switch AI provider berdasarkan .env configuration
 * 
 * Supports:
 * - OpenAI (GPT-3.5 Turbo) - Cepat & Murah
 * - Google Gemini - Gratis
 * - Ollama - Super cepat & Offline
 * 
 * @package App\Services
 */
class PetAIServiceFactory
{
    /**
     * Buat service instance berdasarkan AI_PROVIDER di .env
     * 
     * @return GeminiPetService|OpenAIPetService
     */
    public static function create()
    {
        $provider = strtolower(config('services.ai_provider', 'gemini'));

        return match ($provider) {
            'openai' => new OpenAIPetService(),
            'gemini' => new GeminiPetService(),
            default => new GeminiPetService(), // Default fallback
        };
    }

    /**
     * Get current active provider name
     * 
     * @return string
     */
    public static function getProvider(): string
    {
        return strtolower(config('services.ai_provider', 'gemini'));
    }

    /**
     * Get provider info (untuk debugging)
     * 
     * @return array
     */
    public static function getProviderInfo(): array
    {
        $provider = self::getProvider();

        return match ($provider) {
            'openai' => [
                'name' => 'OpenAI GPT-3.5 Turbo',
                'speed' => '500ms - 2s',
                'cost' => '$0.05 per 100 requests',
                'status' => 'Fast & Reliable ⚡',
            ],
            'gemini' => [
                'name' => 'Google Gemini',
                'speed' => '2 - 5s',
                'cost' => 'Free',
                'status' => 'Stable but Slower',
            ],
            default => [
                'name' => 'Unknown',
                'speed' => 'Unknown',
                'cost' => 'Unknown',
                'status' => 'Error',
            ],
        };
    }
}

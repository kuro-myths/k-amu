<?php

namespace App\Http\Controllers;

use App\Models\UserTheme;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ThemeController extends Controller
{
    /**
     * Get the current user's theme settings.
     */
    public function show(): JsonResponse
    {
        $user = Auth::user();

        $theme = $user->theme ?? UserTheme::create([
            'user_id' => $user->id,
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
        ]);

        return response()->json($theme);
    }

    /**
     * Update the current user's theme settings.
     */
    public function update(Request $request): JsonResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'mode' => 'in:normal,private,tor',
            'primary_color' => 'regex:/^#[0-9A-Fa-f]{6}$/',
            'secondary_color' => 'regex:/^#[0-9A-Fa-f]{6}$/',
            'background_color' => 'regex:/^#[0-9A-Fa-f]{6}$/',
            'text_color' => 'regex:/^#[0-9A-Fa-f]{6}$/',
            'accent_color' => 'regex:/^#[0-9A-Fa-f]{6}$/',
            'font_family' => 'in:sans,serif,mono',
            'font_size' => 'in:small,normal,large',
            'font_weight' => 'in:light,normal,bold',
            'dark_mode' => 'boolean',
            'compact_mode' => 'boolean',
        ]);

        $theme = $user->theme ?? new UserTheme(['user_id' => $user->id]);
        $theme->update($validated);

        return response()->json([
            'message' => 'Tema berhasil diperbarui',
            'theme' => $theme,
        ]);
    }

    /**
     * Reset theme to default settings.
     */
    public function reset(): JsonResponse
    {
        $user = Auth::user();

        $theme = $user->theme ?? new UserTheme(['user_id' => $user->id]);

        $theme->update([
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
        ]);

        return response()->json([
            'message' => 'Tema berhasil di-reset',
            'theme' => $theme,
        ]);
    }

    /**
     * Get theme preset templates.
     */
    public function presets(): JsonResponse
    {
        $presets = [
            'light' => [
                'name' => 'Light Mode',
                'mode' => 'normal',
                'primary_color' => '#3b82f6',
                'secondary_color' => '#8b5cf6',
                'background_color' => '#ffffff',
                'text_color' => '#000000',
                'accent_color' => '#ec4899',
                'dark_mode' => false,
            ],
            'dark' => [
                'name' => 'Dark Mode',
                'mode' => 'normal',
                'primary_color' => '#60a5fa',
                'secondary_color' => '#a78bfa',
                'background_color' => '#1f2937',
                'text_color' => '#f3f4f6',
                'accent_color' => '#f472b6',
                'dark_mode' => true,
            ],
            'nord' => [
                'name' => 'Nord Theme',
                'mode' => 'normal',
                'primary_color' => '#88c0d0',
                'secondary_color' => '#81a1c1',
                'background_color' => '#2e3440',
                'text_color' => '#eceff4',
                'accent_color' => '#bf616a',
                'dark_mode' => true,
            ],
            'dracula' => [
                'name' => 'Dracula Theme',
                'mode' => 'normal',
                'primary_color' => '#bd93f9',
                'secondary_color' => '#8be9fd',
                'background_color' => '#282a36',
                'text_color' => '#f8f8f2',
                'accent_color' => '#ff79c6',
                'dark_mode' => true,
            ],
            'private' => [
                'name' => 'Private Mode',
                'mode' => 'private',
                'primary_color' => '#6366f1',
                'secondary_color' => '#06b6d4',
                'background_color' => '#0f172a',
                'text_color' => '#e2e8f0',
                'accent_color' => '#f43f5e',
                'dark_mode' => true,
            ],
            'tor' => [
                'name' => 'Tor Mode',
                'mode' => 'tor',
                'primary_color' => '#7c3aed',
                'secondary_color' => '#6d28d9',
                'background_color' => '#1a1a1a',
                'text_color' => '#d1d5db',
                'accent_color' => '#a855f7',
                'dark_mode' => true,
            ],
        ];

        return response()->json($presets);
    }
}

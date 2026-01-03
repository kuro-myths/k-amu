<?php

namespace App\Helpers;

use App\Models\UserTheme;
use Illuminate\Support\Facades\Auth;

class ThemeHelper
{
    /**
     * Get current user's theme
     */
    public static function getUserTheme(): UserTheme
    {
        $user = Auth::user();

        if (!$user) {
            return new UserTheme();
        }

        return $user->theme ?? UserTheme::create([
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
    }

    /**
     * Get theme CSS color variable
     */
    public static function getPrimaryColor(): string
    {
        return self::getUserTheme()->primary_color;
    }

    public static function getSecondaryColor(): string
    {
        return self::getUserTheme()->secondary_color;
    }

    public static function getBackgroundColor(): string
    {
        return self::getUserTheme()->background_color;
    }

    public static function getTextColor(): string
    {
        return self::getUserTheme()->text_color;
    }

    public static function getAccentColor(): string
    {
        return self::getUserTheme()->accent_color;
    }

    /**
     * Get font configuration
     */
    public static function getFontFamily(): string
    {
        return self::getUserTheme()->font_family;
    }

    public static function getFontSize(): string
    {
        return self::getUserTheme()->font_size;
    }

    public static function getFontWeight(): string
    {
        return self::getUserTheme()->font_weight;
    }

    /**
     * Get theme mode
     */
    public static function getMode(): string
    {
        return self::getUserTheme()->mode;
    }

    /**
     * Check if dark mode is enabled
     */
    public static function isDarkMode(): bool
    {
        return self::getUserTheme()->dark_mode;
    }

    /**
     * Check if compact mode is enabled
     */
    public static function isCompactMode(): bool
    {
        return self::getUserTheme()->compact_mode;
    }

    /**
     * Generate inline CSS for theme
     */
    public static function generateInlineCSS(): string
    {
        $theme = self::getUserTheme();

        $fontFamily = 'system-ui, -apple-system, sans-serif';
        if ($theme->font_family === 'serif') {
            $fontFamily = 'Georgia, "Times New Roman", serif';
        } elseif ($theme->font_family === 'mono') {
            $fontFamily = '"Courier New", Courier, monospace';
        }

        $fontSize = '1rem';
        if ($theme->font_size === 'small') {
            $fontSize = '0.875rem';
        } elseif ($theme->font_size === 'large') {
            $fontSize = '1.25rem';
        }

        $fontWeight = '400';
        if ($theme->font_weight === 'light') {
            $fontWeight = '300';
        } elseif ($theme->font_weight === 'bold') {
            $fontWeight = '700';
        }

        return sprintf(
            ':root { --primary-color: %s; --secondary-color: %s; --background-color: %s; --text-color: %s; --accent-color: %s; --font-family: %s; --font-size: %s; --font-weight: %s; }',
            $theme->primary_color,
            $theme->secondary_color,
            $theme->background_color,
            $theme->text_color,
            $theme->accent_color,
            $fontFamily,
            $fontSize,
            $fontWeight
        );
    }

    /**
     * Generate theme class names
     */
    public static function generateThemeClasses(): string
    {
        $theme = self::getUserTheme();
        $classes = [
            'theme-' . $theme->mode,
            'font-' . $theme->font_family,
            'size-' . $theme->font_size,
            'weight-' . $theme->font_weight,
        ];

        if ($theme->dark_mode) {
            $classes[] = 'dark-mode';
        }

        if ($theme->compact_mode) {
            $classes[] = 'compact-mode';
        }

        return implode(' ', $classes);
    }
}

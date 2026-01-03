<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property string $mode (normal, private, tor)
 * @property string $primary_color
 * @property string $secondary_color
 * @property string $background_color
 * @property string $text_color
 * @property string $accent_color
 * @property string $font_family (sans, serif, mono)
 * @property string $font_size (small, normal, large)
 * @property string $font_weight (light, normal, bold)
 * @property bool $dark_mode
 * @property bool $compact_mode
 */
class UserTheme extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mode',
        'primary_color',
        'secondary_color',
        'background_color',
        'text_color',
        'accent_color',
        'font_family',
        'font_size',
        'font_weight',
        'dark_mode',
        'compact_mode',
    ];

    protected $casts = [
        'dark_mode' => 'boolean',
        'compact_mode' => 'boolean',
    ];

    /**
     * Get the user that owns the theme.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

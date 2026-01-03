<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property string $query
 * @property int $result_count
 * @property string|null $tags
 * @property bool $is_bookmarked
 * @property string|null $last_searched_at
 */
class SearchHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'query',
        'result_count',
        'tags',
        'is_bookmarked',
        'last_searched_at',
    ];

    protected $casts = [
        'is_bookmarked' => 'boolean',
        'last_searched_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the search history.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get tags as array
     */
    public function getTagsArray(): array
    {
        return $this->tags ? json_decode($this->tags, true) : [];
    }

    /**
     * Set tags from array
     */
    public function setTagsArray(array $tags): void
    {
        $this->tags = json_encode($tags);
    }
}

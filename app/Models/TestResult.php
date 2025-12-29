<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestResult extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tester_id',
        'feature_name',
        'test_description',
        'status',
        'percentage',
        'test_cases',
        'notes',
        'environment',
    ];

    protected $casts = [
        'test_cases' => 'json',
        'environment' => 'json',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function tester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tester_id');
    }

    public function markAsPassed(): void
    {
        $this->update([
            'status' => 'passed',
            'percentage' => 100,
        ]);
    }

    public function markAsFailed(): void
    {
        $this->update(['status' => 'failed']);
    }

    public function markAsInProgress(): void
    {
        $this->update(['status' => 'in_progress']);
    }
}

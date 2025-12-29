<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'leader_id',
        'name',
        'description',
        'status',
        'start_date',
        'end_date',
        'progress',
        'team_members',
    ];

    protected $casts = [
        'team_members' => 'json',
        'start_date' => 'date',
        'end_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function leader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    public function getTeamMembers()
    {
        $memberIds = $this->team_members ?? [];
        return User::whereIn('id', $memberIds)->get();
    }

    public function addTeamMember($userId): void
    {
        $members = $this->team_members ?? [];
        if (!in_array($userId, $members)) {
            $members[] = $userId;
            $this->update(['team_members' => $members]);
        }
    }

    public function removeTeamMember($userId): void
    {
        $members = $this->team_members ?? [];
        $members = array_filter($members, fn($id) => $id !== $userId);
        $this->update(['team_members' => array_values($members)]);
    }
}

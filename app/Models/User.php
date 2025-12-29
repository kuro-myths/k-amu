<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property HasMany $messages
 * @property HasMany $receivedMessages
 * @property HasMany $notes
 * @property HasMany $projects
 * @property HasMany $bugReports
 * @property HasMany $assignedBugs
 * @property HasMany $testResults
 * @property HasMany $activityLogs
 * @property HasMany $notifications
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'user_type',
        'bio',
        'avatar',
        'phone',
        'address',
        'cv',
        'level',
        'points',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'last_login_at' => 'datetime',
        ];
    }

    // Relations
    /**
     * Get all messages sent by this user.
     * @return HasMany
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    /**
     * Get all messages received by this user.
     * @return HasMany
     */
    public function receivedMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'recipient_id');
    }

    /**
     * Get all notes created by this user.
     * @return HasMany
     */
    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }

    /**
     * Get all projects led by this user.
     * @return HasMany
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'leader_id');
    }

    /**
     * Get all bug reports submitted by this user.
     * @return HasMany
     */
    public function bugReports(): HasMany
    {
        return $this->hasMany(BugReport::class, 'reporter_id');
    }

    /**
     * Get all bug reports assigned to this user.
     * @return HasMany
     */
    public function assignedBugs(): HasMany
    {
        return $this->hasMany(BugReport::class, 'assigned_to');
    }

    /**
     * Get all test results for this user.
     * @return HasMany
     */
    public function testResults(): HasMany
    {
        return $this->hasMany(TestResult::class, 'tester_id');
    }

    /**
     * Get all activity logs for this user.
     * @return HasMany
     */
    public function activityLogs(): HasMany
    {
        return $this->hasMany(ActivityLog::class);
    }

    /**
     * Get all notifications for this user.
     * @return HasMany
     */
    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    // Helper methods for role checking
    public function isSuperAdmin(): bool
    {
        return $this->role === 'superadmin';
    }

    public function isMastercard(): bool
    {
        return $this->role === 'mastercard';
    }

    public function isLeader(): bool
    {
        return $this->role === 'leader';
    }

    public function isTester(): bool
    {
        return $this->role === 'tester';
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }
}

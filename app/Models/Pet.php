<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'pet_type',
        'role_type',
        'level',
        'experience',
        'health',
        'happiness',
        'energy',
        'biography',
        'stats',
        'abilities',
        'last_interaction',
    ];

    protected $casts = [
        'stats' => 'array',
        'abilities' => 'array',
        'last_interaction' => 'datetime',
    ];

    /**
     * Relationship ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Add experience to pet
     */
    public function addExperience(int $amount)
    {
        $this->experience += $amount;

        // Level up setiap 100 experience
        if ($this->experience >= 100) {
            $this->level += intval($this->experience / 100);
            $this->experience = $this->experience % 100;
        }

        $this->save();
    }

    /**
     * Interact dengan pet (increase happiness, energy decrease)
     */
    public function interact()
    {
        $this->happiness = min(100, $this->happiness + 10);
        $this->energy = max(0, $this->energy - 5);
        $this->last_interaction = now();
        $this->addExperience(5);
        $this->save();
    }

    /**
     * Rest pet
     */
    public function rest()
    {
        $this->energy = min(100, $this->energy + 30);
        $this->health = min(100, $this->health + 15);
        $this->save();
    }
};

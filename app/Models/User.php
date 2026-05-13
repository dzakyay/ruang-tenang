<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_picture',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    // ── Relationships ─────────────────────────────────────────────────────────

    public function emotions(): HasMany
    {
        return $this->hasMany(Emotion::class);
    }

    public function journals(): HasMany
    {
        return $this->hasMany(Journal::class);
    }

    // ── Helper methods ────────────────────────────────────────────────────────

    public function todayEmotion(): ?Emotion
    {
        return $this->emotions()
            ->whereDate('created_at', today())
            ->latest()
            ->first();
    }

    // ── Accessors ─────────────────────────────────────────────────────────────

    public function getProfilePictureUrlAttribute(): string
    {
        if ($this->profile_picture) {
            return asset('storage/' . $this->profile_picture);
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=a07954&color=fff';
    }
}

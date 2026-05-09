<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Emotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mood',
        'score',
        'note',
    ];

    protected $casts = [
        'score'      => 'integer',
        'created_at' => 'datetime',
    ];

    // Mood constants with all metadata in one place
    const MOODS = [
        'sedih'    => ['label' => 'Sedih',         'emoji' => '😔', 'score' => 1, 'color' => '#6b7280'],
        'biasa'    => ['label' => 'Biasa',          'emoji' => '😐', 'score' => 2, 'color' => '#d4b996'],
        'senang'   => ['label' => 'Senang',         'emoji' => '😊', 'score' => 3, 'color' => '#a07954'],
        'sangat'   => ['label' => 'Sangat Senang',  'emoji' => '😍', 'score' => 4, 'color' => '#614d3c'],
        'semangat' => ['label' => 'Semangat',       'emoji' => '🔥', 'score' => 5, 'color' => '#5c442b'],
    ];

    // ── Relationships ─────────────────────────────────────────────────────────

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // ── Accessors ─────────────────────────────────────────────────────────────

    public function getMoodLabelAttribute(): string
    {
        return self::MOODS[$this->mood]['label'] ?? $this->mood;
    }

    public function getMoodEmojiAttribute(): string
    {
        return self::MOODS[$this->mood]['emoji'] ?? '😐';
    }

    public function getMoodColorAttribute(): string
    {
        return self::MOODS[$this->mood]['color'] ?? '#d4b996';
    }

    // ── Scopes ────────────────────────────────────────────────────────────────

    public function scopeLastDays($query, int $days = 7)
    {
        return $query->where('created_at', '>=', now()->subDays($days)->startOfDay());
    }

    public function scopeThisMonth($query)
    {
        return $query->whereYear('created_at', now()->year)
                     ->whereMonth('created_at', now()->month);
    }
}

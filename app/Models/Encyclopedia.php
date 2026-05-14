<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Encyclopedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'feeling',
        'description',
        'banner',
        'category',
        'quote',
        'content',
    ];

    public function tips()
    {
        return $this->hasMany(EncyclopediaTip::class);
    }

    // ── Accessors ─────────────────────────────────────────────────────────────

    public function getBannerUrlAttribute(): ?string
    {
        if (!$this->banner) {
            return null;
        }

        if (str_starts_with($this->banner, 'http')) {
            return $this->banner;
        }

        return asset('storage/' . $this->banner);
    }

    public function getSlugAttribute(): string
    {
        return Str::slug($this->feeling);
    }

    // ── Scopes ────────────────────────────────────────────────────────────────

    public function scopeCategory($query, ?string $category)
    {
        if (!$category || $category === 'semua') {
            return $query;
        }

        return $query->where('category', $category);
    }

    public function scopeSearch($query, ?string $term)
    {
        if (!$term) {
            return $query;
        }

        return $query->where('feeling', 'like', "%{$term}%")
                     ->orWhere('description', 'like', "%{$term}%");
    }

    
}

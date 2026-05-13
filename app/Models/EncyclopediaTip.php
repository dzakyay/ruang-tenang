<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EncyclopediaTip extends Model
{
    protected $fillable = [
        'encyclopedia_id',
        'title',
        'description',
        'icon',
    ];

    public function getIconUrlAttribute(): ?string
    {
        if (!$this->icon) {
            return null;
        }

        if (str_starts_with($this->icon, 'http')) {
            return $this->icon;
        }

        return asset('storage/' . $this->icon);
    }

    public function encyclopedia()
    {
        return $this->belongsTo(Encyclopedia::class);
    }
}

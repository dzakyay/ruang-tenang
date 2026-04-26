<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Journal extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'content',
        'banner',
        'media',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

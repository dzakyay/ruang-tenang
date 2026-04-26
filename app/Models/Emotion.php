<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emotion extends Model
{
    protected $fillable = ['user_id', 'mood', 'score'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

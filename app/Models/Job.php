<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'location',
        'type',
        'salary',
        'is_active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


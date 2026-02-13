<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Candidate extends Model
{
    protected $fillable = [
        'user_id',
        'headhunter_id',
        'phone',
        'birth_date',
        'bio',
        'linkedin_url',
        'resume_path',
        'profile_completed',
    ];

    /**
     * Candidate pertence a um User (login)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Candidate pertence a um Headhunter
     */
    public function headhunter()
    {
        return $this->belongsTo(User::class, 'headhunter_id');
    }
}

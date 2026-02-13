<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Candidate;
use App\Models\Job;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'referral_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function booted()
    {
        static::creating(function ($user) {
            if ($user->role === 'headhunter' && empty($user->referral_token)) {
                $user->referral_token = \Str::uuid();
            }
        });
    }

    /**
     * Se o usuário for candidate → possui um profile
     */
    public function candidate()
    {
        return $this->hasOne(Candidate::class);
    }

    /**
     * Se o usuário for headhunter → possui vários candidates
     */
    public function candidates()
    {
        return $this->hasMany(Candidate::class, 'headhunter_id');
    }

    /**
     * Headhunter possui várias vagas
     */
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}

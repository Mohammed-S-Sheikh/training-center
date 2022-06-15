<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    protected $perPage = 10;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public const FILTERS = [
        \App\Services\Pipeline\User\CityId::class,
        \App\Services\Pipeline\User\CreatedAt::class,
        \App\Services\Pipeline\User\IsAdmin::class,
        \App\Services\Pipeline\User\Search::class,
    ];

    public function trainees()
    {
        return $this->hasMany(Trainee::class)->where('is_paid', true);
    }

    public function leads()
    {
        return $this->hasMany(Trainee::class)->where('is_paid', false);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}

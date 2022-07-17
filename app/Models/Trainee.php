<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trainee extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $perPage = 10;

    public const FILTERS = [
        \App\Services\Pipeline\Trainee\CountryId::class,
        \App\Services\Pipeline\Trainee\CreatedAt::class,
        \App\Services\Pipeline\Trainee\Ly::class,
        \App\Services\Pipeline\Trainee\Search::class,
        \App\Services\Pipeline\Trainee\Us::class,
        \App\Services\Pipeline\Trainee\UserId::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}

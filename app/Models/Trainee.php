<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trainee extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public const FILTERS = [
        \App\Services\Pipeline\Trainee\Amount::class,
        \App\Services\Pipeline\Trainee\Discount::class,
        \App\Services\Pipeline\Trainee\Search::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function trainees()
    {
        return $this->hasMany(Trainee::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}

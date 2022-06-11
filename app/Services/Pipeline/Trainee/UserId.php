<?php

namespace App\Services\Pipeline\Trainee;

use App\Services\Pipeline\Filter;

class UserId extends Filter
{
    public function applyFilter($builder)
    {
        return $builder->where('user_id', request($this->filterName()));
    }
}

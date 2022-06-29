<?php

namespace App\Services\Pipeline\User;

use App\Services\Pipeline\Filter;

class IsAdmin extends Filter
{
    public function applyFilter($builder)
    {
        return $builder->where('role', request($this->filterName()));
    }
}

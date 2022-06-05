<?php

namespace App\Services\Pipeline\User;

use App\Services\Pipeline\Filter;

class Name extends Filter
{
    public function applyFilter($builder)
    {
        return $builder->where('name', 'LIKE', '%' . request($this->filterName()) . '%');
    }
}

<?php

namespace App\Services\Pipeline\Trainee;

use App\Services\Pipeline\Filter;

class Name extends Filter
{
    public function applyFilter($builder)
    {
        return $builder->where('name', 'LIKE', '%' . request($this->filterName()) . '%');
    }
}

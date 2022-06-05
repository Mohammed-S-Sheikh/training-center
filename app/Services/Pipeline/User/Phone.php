<?php

namespace App\Services\Pipeline\User;

use App\Services\Pipeline\Filter;

class Phone extends Filter
{
    public function applyFilter($builder)
    {
        return $builder->where('phone', 'LIKE', '%' . request($this->filterName()) . '%');
    }
}

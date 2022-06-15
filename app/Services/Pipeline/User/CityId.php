<?php

namespace App\Services\Pipeline\User;

use App\Services\Pipeline\Filter;

class CityId extends Filter
{
    public function applyFilter($builder)
    {
        return $builder->where('city_id', request($this->filterName()));
    }
}

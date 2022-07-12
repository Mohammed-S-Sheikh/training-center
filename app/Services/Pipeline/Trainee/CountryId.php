<?php

namespace App\Services\Pipeline\Trainee;

use App\Services\Pipeline\Filter;

class CountryId extends Filter
{
    public function applyFilter($builder)
    {
        return $builder->where('country_id', request($this->filterName()));
    }
}

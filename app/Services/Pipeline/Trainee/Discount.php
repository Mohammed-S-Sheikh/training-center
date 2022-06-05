<?php

namespace App\Services\Pipeline\Trainee;

use App\Services\Pipeline\Filter;

class Discount extends Filter
{
    public function applyFilter($builder)
    {
        if (request($this->filterName())[0] > request($this->filterName())[1]) {
            [$max, $min] = request($this->filterName());
        } else {
            [$min, $max] = request($this->filterName());
        }

        return $builder->whereBetween('discount', [$min, $max]);
    }
}

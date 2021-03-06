<?php

namespace App\Services\Pipeline\User;

use App\Services\Pipeline\Filter;

class CreatedAt extends Filter
{
    public function applyFilter($builder)
    {
        if (request($this->filterName())[0] > request($this->filterName())[1]) {
            [$max, $min] = request($this->filterName());
        } else {
            [$min, $max] = request($this->filterName());
        }

        return $builder->whereBetween('created_at', [$min, $max]);
    }
}

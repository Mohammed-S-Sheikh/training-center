<?php

namespace App\Services\Pipeline\Trainee;

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

        if (!$min || !$max) return $builder;

        return $builder->whereBetween('created_at', [$min, $max]);
    }
}

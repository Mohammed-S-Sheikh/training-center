<?php

namespace App\Services\Pipeline\Trainee;

use App\Services\Pipeline\Filter;

class Search extends Filter
{
    public function applyFilter($builder)
    {
        return $builder->where(function ($query) {
            $query
                ->where('email', 'LIKE', '%' . request($this->filterName()) . '%')
                ->orWhere('name', 'LIKE', '%' . request($this->filterName()) . '%')
                ->orWhere('phone', 'LIKE', '%' . request($this->filterName()) . '%');
        });
    }
}

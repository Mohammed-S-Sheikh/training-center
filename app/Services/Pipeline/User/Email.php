<?php

namespace App\Services\Pipeline\User;

use App\Services\Pipeline\Filter;

class Email extends Filter
{
    public function applyFilter($builder)
    {
        return $builder->where('email', 'LIKE', '%' . request($this->filterName()) . '%');
    }
}

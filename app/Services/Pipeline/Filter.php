<?php

namespace App\Services\Pipeline;

use Closure;
use illuminate\Support\Str;

abstract class Filter
{
    public function handle($request, Closure $next)
    {
        if (
            request()->has($this->filterName()) &&
            !empty(request($this->filterName()))
        ) {
            return $this->applyFilter($next($request));
        }

        return $next($request);
    }

    protected abstract function applyFilter($builder);

    protected function filterName()
    {
        return Str::snake(class_basename($this));
    }
}

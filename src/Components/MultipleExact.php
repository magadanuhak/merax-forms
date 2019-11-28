<?php


namespace MeraxForms\Components;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class MultipleExact implements Filter
{
    public function __invoke(Builder $query, $value, string $property): Builder
    {
        return is_array($value) ?
            $query->whereIn($property, $value) :
            $query->where($property, $value);
    }
}
//todo De Se utilizeaza spatieQueryBuilder

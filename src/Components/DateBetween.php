<?php


namespace MeraxForms\Components;


use Carbon\Carbon;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class DateBetween implements Filter
{
    public function __invoke(Builder $query, $value, string $property) : Builder
    {
        return $query->whereBetween(
            $property,
            [
                Carbon::parse(reset($value)),
                Carbon::parse(end($value)),
            ]
        );
    }
}

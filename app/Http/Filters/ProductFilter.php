<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends AbstractFilter
{
    public const SEARCH = 'search';


    public const CATEGORY = 'category_id';

    protected function getCallbacks(): array
    {
        return [
            self::SEARCH => [$this, 'search'],
            self::CATEGORY => [$this, 'category_id'],
        ];
    }

    public function search(Builder $builder, $value): void
    {
        $builder->where('name', 'like', "%{$value}%");
    }


    public function category_id(Builder $builder, $value): void
    {
        $builder->where('category_id', $value);
    }

}

<?php

namespace App\Actions;

use App\Http\Filters\ProductFilter;
use App\Models\Product;

class GetProductsAction
{
    public function handle(array $data, int $perPage = 10)
    {
        $query = Product::query();

        $filter = app()->make(ProductFilter::class, [
            'queryParams' => array_filter(
                $data,
                fn ($v, $k) => $k !== 'name' && $v !== null,
                ARRAY_FILTER_USE_BOTH
            )
        ]);

        return $query
            ->filter($filter)
            ->with('category')
            ->paginate($perPage);
    }
}

<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Filters\ProductFilter;
use App\Http\Requests\FilterRequest;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FilterRequest $request)
    {
        $data = $request->validated();
        $query = Product::query();
        $filter = app()->make(ProductFilter::class, [
            'queryParams' => array_filter(
                $data,
                fn ($v, $k) => $k !== 'name' && $v !== null,
                ARRAY_FILTER_USE_BOTH
            )
        ]);

//        $products = Product::with('category')e', 10));


        $query->filter($filter);
        $products=  $query->with(['category'])->paginate($request->input('per_page', 10));
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $product = Product::create($request->validated());
        return response(ProductResource::make($product), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return ProductResource::make($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Product $product)
    {
        $product->update($request->validated());
        return response(ProductResource::make($product), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::destroy($id);
        return response(null, 204);
    }
}

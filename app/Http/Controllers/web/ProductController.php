<?php

namespace App\Http\Controllers\web;

use App\Actions\GetProductsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\FilterRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index(FilterRequest $request, GetProductsAction $action)
    {
        $products = $action->handle($request->validated());
        return Inertia::render('index', [
            'data' => ProductResource::collection($products)
        ]);
    }

    public function show(Product $product)
    {
        return Inertia::render('products/show', [
            'product' => ProductResource::make($product)->resolve()
        ]);
    }

}

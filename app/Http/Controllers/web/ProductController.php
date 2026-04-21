<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('category')->paginate($request->input('per_page', 10));
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

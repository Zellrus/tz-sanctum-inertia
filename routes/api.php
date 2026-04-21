<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

//Route::prefix('v1')->group(function () {
//
//}

Route::apiResource('products', ProductController::class);
Route::get('categories', [CategoryController::class, 'index']);



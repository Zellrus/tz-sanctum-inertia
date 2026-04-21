<?php

use App\Http\Controllers\api\auth\AuthController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
//Route::prefix('v1')->group(function () {
//
//}

Route::apiResource('products', ProductController::class)->only(['index', 'show']);
Route::get('categories', [CategoryController::class, 'index']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {return $request->user();});
    Route::apiResource('products', ProductController::class)->except(['index', 'show']);
    Route::post('logout', [AuthController::class, 'logout']);
});

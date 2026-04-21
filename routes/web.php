<?php


use App\Http\Controllers\web\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('/admin/products', [\App\Http\Controllers\web\admin\ProductController::class, 'index'])->name('admin.products.index');


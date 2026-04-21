<?php


use App\Http\Controllers\web\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('/admin/products', [\App\Http\Controllers\web\admin\ProductController::class, 'index'])->name('admin.products.index');
Route::get('/admin/products/create', [\App\Http\Controllers\web\admin\ProductController::class, 'create'])->name('admin.products.create');
Route::get('/admin/products/{product}/edit', [\App\Http\Controllers\web\admin\ProductController::class, 'edit'])->name('admin.products.edit');


<?php

use App\Http\Controllers\testController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [TestController::class, 'index']);



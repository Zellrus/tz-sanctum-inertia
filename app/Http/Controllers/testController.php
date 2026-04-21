<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class testController extends Controller
{
    public function index()
    {
        return Inertia::render('app', ['bla'=>123111]);
    }
}

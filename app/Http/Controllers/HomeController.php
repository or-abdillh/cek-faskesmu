<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    //
    public function index()
    {
        return Inertia::render('Welcome');
    }

    public function about()
    {
        return 'about page';
    }
}

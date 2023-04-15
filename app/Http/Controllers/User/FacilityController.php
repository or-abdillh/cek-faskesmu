<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FacilityController extends Controller
{
    //

    public function index()
    {
        return Inertia::render('Facility/Index');
    }
}

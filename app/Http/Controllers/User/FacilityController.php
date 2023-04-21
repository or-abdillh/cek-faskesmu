<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FacilityController extends Controller
{
    //

    public function detail($slug)
    {
        $facility = Facility::where('slug', $slug)->first();

        return Inertia::render('Facility/Detail', [ "facility" => $facility ]);
    }
}

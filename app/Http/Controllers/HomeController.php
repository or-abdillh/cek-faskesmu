<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Location;
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

    public function facility()
    {
        $facilities = Facility::all()->map(function($facility) {
            return [
                "name" => $facility->name,
                "category" => $facility->category,
                "address" => $facility->address,
                "longitude" => $facility->longitude,
                "latitude" => $facility->latitude,
                "location" => $facility->location->city,
                "URL" => route('user.facility.detail', $facility->slug)
            ];
        });

        $center_lat = $facilities->avg('latitude');
        $center_lng = $facilities->avg('longitude');

        $locations = Location::select('city')->get();

        // return response()->json($facilities);

        return Inertia::render('Facility/Index', [
            'facilities' => $facilities,
            'locations' => $locations,
            'centerMap' => [
                'lat' => $center_lat,
                'lng' => $center_lng
            ],
            'isLogin' => auth()->check()
        ]);
    }
}

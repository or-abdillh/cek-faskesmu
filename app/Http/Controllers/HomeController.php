<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use App\Models\Facility;
use App\Models\Favorite;
use App\Models\Location;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    //
    public function index()
    {
        $stats = [
            [ "title" => "Lokasi", "count" => Location::all()->count() ],
            [ "title" => "Pengguna", "count" => User::role('user')->count() ],
            [ "title" => "Faskes Terdaftar", "count" => Facility::all()->count() ],
            [ "title" => "Layanan Kesehatan", "count" => Service::all()->count() ],
            [ "title" => "Obat Tersedia", "count" => Drug::all()->count() ]
        ];

        return Inertia::render('Welcome', [ "stats" => $stats ]);
    }

    public function about()
    {
        return 'about page';
    }

    public function facility()
    {

        $facilities = Facility::all()->map(function($facility) {
            return [
                "id" => $facility->id,
                "name" => $facility->name,
                "category" => $facility->category,
                "address" => $facility->address,
                "longitude" => $facility->longitude,
                "latitude" => $facility->latitude,
                "location" => $facility->location->city,
                "URL" => route('user.facility.detail', $facility->slug),
                "rate" => number_format($facility->reviews->avg('rate'), 1),
                "userHasRate" => $facility->reviews->count(),
                "isUserFavorite" => Favorite::where('user_id', auth()->user()->id)->where('favoritable_type', 'App\Models\Facility')->where('favoritable_id', $facility->id)->first()
            ];
        });

        $center_lat = $facilities->avg('latitude');
        $center_lng = $facilities->avg('longitude');

        $locations = Location::select('city')->get();

        // return $facilities;

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

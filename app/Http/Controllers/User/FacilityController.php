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
        $drugs = $facility->drugs;
        $services = $facility->services;
        $provider = $facility->user;

        $reviews = $facility->reviews->map(function($review) {
            return [
                'username' => $review->user->name,
                'content' => $review->content,
                'created_at' => $review->created_at->diffForHumans()
            ];
        });

        return Inertia::render('Facility/Detail', [ 
            "facility" => $facility,
            "services" => $services,
            "drugs" => $drugs,
            "provider" => $provider,
            "reviews" => $reviews
        ]);
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\Review;
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
                'created_at' => $review->created_at->diffForHumans(),
                'count' => Review::where('user_id', $review->user->id)->where('reviewable_type', 'App\Models\Facility')->count(),
                'rate' => $review->rate
            ];
        });

        $rateAverage = number_format( $facility->reviews->avg('rate') , 1);

        return Inertia::render('Facility/Detail', [ 
            "facility" => $facility,
            "services" => $services,
            "drugs" => $drugs,
            "provider" => $provider,
            "reviews" => $reviews,
            "rateAverage" => $rateAverage
        ]);
    }
}

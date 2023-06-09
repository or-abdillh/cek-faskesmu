<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Drug;
use App\Models\Facility;
use App\Models\Favorite;
use App\Models\Review;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class FacilityController extends Controller
{
    //

    public function detail($slug)
    {
        $facility = Facility::where('slug', $slug)->first();
        $provider = $facility->user;

        $drugs = $facility->drugs
            ->map(function($drug) use ($facility) {
                return [
                    "id" => $drug->id,
                    "name" => $drug->name,
                    "description" => $drug->description,
                    "price" => $drug->price,
                    "unit_type" => $drug->unit_type,
                    "userHasRate" => $drug->reviews->count(),
                    "priceCompareUrl" => route('user.facility.price-compare.drug', ['facility_slug' => $facility->slug, 'id' => $drug->id]),

                    "rate" => number_format( $drug->reviews->avg('rate'), 1 ),

                    "isUserFavorite" => Favorite::where('user_id', auth()->user()->id)->where('favoritable_type', 'App\Models\Drug')->where('favoritable_id', $drug->id)->first(),

                    "reviews" => Review::where('reviewable_type', 'App\\Models\\Drug')
                        ->where('reviewable_id', $drug->id)
                        ->latest()
                        ->get()
                        ->map(function($review) {
                            return [
                                'username' => $review->user->name,
                                'content' => $review->content,
                                'created_at' => $review->created_at->diffForHumans(),
                                'rate' => $review->rate
                            ];
                        })
                ];
            });

        $services = $facility->services
            ->map(function($service) use ($facility) {
                return [
                    "id" => $service->id,
                    "name" => $service->name,
                    "description" => $service->description,
                    "price" => $service->price,
                    "unit_type" => $service->unit_type,
                    "userHasRate" => $service->reviews->count(),
                    "priceCompareUrl" => route('user.facility.price-compare.service', ['facility_slug' => $facility->slug, 'id' => $service->id]),

                    "rate" => number_format( $service->reviews->avg('rate'), 1 ),
                    
                    "isUserFavorite" => Favorite::where('user_id', auth()->user()->id)->where('favoritable_type', 'App\Models\Service')->where('favoritable_id', $service->id)->first(),
                    
                    "reviews" => Review::where('reviewable_type', 'App\\Models\\Service')
                        ->where('reviewable_id', $service->id)
                        ->latest()
                        ->get()
                        ->map(function($review) {
                            return [
                                'username' => $review->user->name,
                                'content' => $review->content,
                                'created_at' => $review->created_at->diffForHumans(),
                                'rate' => $review->rate
                            ];
                        })
                ];
            });

        // return $services;

        $reviews = Review::where('reviewable_type', 'App\\Models\\Facility')
            ->where('reviewable_id', $facility->id)
            ->latest()
            ->get()
            ->map(function($review) {
                return [
                    'username' => $review->user->name,
                    'content' => $review->content,
                    'created_at' => $review->created_at->diffForHumans(),
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

    public function update(Request $request, $id)
    {
        $facility = Facility::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'location_id' => 'required',
            'category' => 'required',
            'description' => 'required',
            'address' => 'required',
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'website' => 'url',
            'longitude' => 'required|numeric|between:-360,360',
            'latitude' => 'required|numeric|between:-360,360'
        ]);

        $facility->update($request->all());

        activity()->log('Melakukan perubahan pada fasilitas');
    }

    public function reset()
    {
        // Get current user for the facility
        $user = User::find(auth()->user()->id);
        
        // delete the facility
        $facility = Facility::findOrFail($user->facility->id);

        activity()->log('Menghapus permanen fasilitas kesehatan ' . $facility->name);

        $facility->delete();

        // change user role
        $user->removeRole('provider');
        $user->assignRole('user');
        $user->save();

        activity()->log('Status akun berubah menjadi pengguna biasa');

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'user_id' => 'numeric|required',
            'location_id' => 'numeric|required',
            'category' => 'required',
            'description' => 'required',
            'address' => 'required',
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'longitude' => 'required|numeric|between:-360,360',
            'latitude' => 'required|numeric|between:-360,360'
        ]);

        // Get current user for assign as a provider
        $user = User::find($request->user_id);

        // Create facility
        Facility::create($request->all());
        activity()->log('Membuat fasilitas kesehatan baru ' . $request->name);

        // Assign role
        $user->removeRole('user');
        $user->assignRole('provider');
        $user->save();

        activity()->log('Status akun berubah menjadi provider dari ' . $request->name);
    }

    public function serviceCompare($facilitySlug, $id)
    {
        // Get the facility
        $facility = Facility::where('slug', $facilitySlug)->first();

        // Get the service 
        $service = Service::findOrFail($id);

        $compares = Service::where('name', 'LIKE', '%' . $service->name .'%')
            ->whereHas('facility', function($query) use ($facility) {
                $query->where('location_id', $facility->location_id)
                    ->whereNot('facility_id', $facility->id);
            })
            ->get()
            ->map(function($compare) use ($facility){
                return [
                    "id" => $compare->id,
                    "name" => $compare->name,
                    "price" => $compare->price,
                    "unit_type" => $compare->unit_type,
                    "description" => $compare->description,
                    "userHasRate" => $compare->reviews->count(),
                    "rate" => number_format( $compare->reviews->avg('rate'), 1 ),
                    "facilityUrl" => route('user.facility.detail', ['slug' => $compare->facility->slug ]) . '?' . http_build_query([ 'key' => strtolower($compare->name), 'type' => 'service' ]),
                    "facilityName" => $compare->facility->name,
                    "location" => $facility->location->city
                ];
            });

        return Inertia::render('Facility/PriceCompare', [
            "item" => [
                "id" => $service->id,
                "name" => $service->name,
                "description" => $service->description,
                "price" => $service->price,
                "unit_type" => $service->unit_type,
                "userHasRate" => $service->reviews->count(),
                "rate" => number_format( $service->reviews->avg('rate'), 1 ),
                "isUserFavorite" => Favorite::where('user_id', auth()->user()->id)->where('favoritable_type', 'App\Models\Service')->where('favoritable_id', $service->id)->first(),
            ],
            "compares" => $compares
        ]);
    }

    public function drugCompare($facilitySlug, $id)
    {
        // Get the facility
        $facility = Facility::where('slug', $facilitySlug)->first();

        // Get the service 
        $drug = Drug::findOrFail($id);

        $compares = Drug::where('name', 'LIKE', '%' . $drug->name .'%')
            ->whereHas('facility', function($query) use ($facility) {
                $query->where('location_id', $facility->location_id)
                    ->whereNot('facility_id', $facility->id);
            })
            ->get()
            ->map(function($compare) use ($facility){
                return [
                    "id" => $compare->id,
                    "name" => $compare->name,
                    "price" => $compare->price,
                    "unit_type" => $compare->unit_type,
                    "description" => $compare->description,
                    "userHasRate" => $compare->reviews->count(),
                    "rate" => number_format( $compare->reviews->avg('rate'), 1 ),
                    "facilityUrl" => route('user.facility.detail', ['slug' => $compare->facility->slug ]) . '?' . http_build_query([ 'key' => strtolower($compare->name), 'type' => 'drug' ]),
                    "facilityName" => $compare->facility->name,
                    "location" => $facility->location->city
                ];
            });

        return Inertia::render('Facility/PriceCompare', [
            "item" => [
                "id" => $drug->id,
                "name" => $drug->name,
                "description" => $drug->description,
                "price" => $drug->price,
                "unit_type" => $drug->unit_type,
                "userHasRate" => $drug->reviews->count(),
                "rate" => number_format( $drug->reviews->avg('rate'), 1 ),
                "isUserFavorite" => Favorite::where('user_id', auth()->user()->id)->where('favoritable_type', 'App\Models\Drug')->where('favoritable_id', $drug->id)->first(),
            ],
            "compares" => $compares
        ]);
    }
}

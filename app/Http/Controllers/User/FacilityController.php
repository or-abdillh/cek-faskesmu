<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\Favorite;
use App\Models\Review;
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
            ->map(function($drug) {
                return [
                    "id" => $drug->id,
                    "name" => $drug->name,
                    "description" => $drug->description,
                    "price" => $drug->price,
                    "unit_type" => $drug->unit_type,
                    "userHasRate" => $drug->reviews->count(),

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
            ->map(function($service) {
                return [
                    "id" => $service->id,
                    "name" => $service->name,
                    "description" => $service->description,
                    "price" => $service->price,
                    "unit_type" => $service->unit_type,
                    "userHasRate" => $service->reviews->count(),

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
}

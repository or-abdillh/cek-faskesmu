<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Drug;
use App\Models\Facility;
use App\Models\Favorite;
use App\Models\Service;
use App\Models\User;
use DateTime;
use DateTimeZone;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Activitylog\Models\Activity;

class ProfileController extends Controller
{

    public function index()
    {
        // Last login modifier 
        $date = auth()->user()->last_login_at;
        $datetime = new DateTime($date, new DateTimeZone('UTC'));
        $lastLoginAt = $datetime->format('Y-m-d\TH:i:s.u\Z');

        auth()->user()->last_login_at = $lastLoginAt;

        // Get favorite items
        $userFavorites = [
            "facility" => Favorite::where('user_id', auth()->user()->id)
                ->where('favoritable_type', 'App\\Models\\Facility')
                ->get()
                ->map(function($favorite) {
                    $facility = Facility::find($favorite->favoritable_id);

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
                }),

            "service" => Favorite::where('user_id', auth()->user()->id)
                ->where('favoritable_type', 'App\\Models\\Service')
                ->get()
                ->map(function($favorite) {
                    $service = Service::find($favorite->favoritable_id);
                    return [
                        "id" => $service->id,
                        "name" => $service->name,
                        "description" => $service->description,
                        "price" => $service->price,
                        "unit_type" => $service->unit_type,
                        "userHasRate" => $service->reviews->count(),
    
                        "rate" => number_format( $service->reviews->avg('rate'), 1 ),
                        
                        "isUserFavorite" => Favorite::where('user_id', auth()->user()->id)->where('favoritable_type', 'App\Models\Service')->where('favoritable_id', $service->id)->first(),
                    ];
                }),

            "drug" => Favorite::where('user_id', auth()->user()->id)
                ->where('favoritable_type', 'App\\Models\\Drug')
                ->get()
                ->map(function($favorite) {
                    $drug = Drug::find($favorite->favoritable_id);

                    return [
                        "id" => $drug->id,
                        "name" => $drug->name,
                        "description" => $drug->description,
                        "price" => $drug->price,
                        "unit_type" => $drug->unit_type,
                        "userHasRate" => $drug->reviews->count(),
    
                        "rate" => number_format( $drug->reviews->avg('rate'), 1 ),
    
                        "isUserFavorite" => Favorite::where('user_id', auth()->user()->id)->where('favoritable_type', 'App\Models\Drug')->where('favoritable_id', $drug->id)->first(),
                    ];
                })
        ];

        $userActivities = Activity::whereCauserId(auth()->user()->id)
            ->latest()
            ->get()
            ->map(function($activity) {
                return [
                    "id" => $activity->id,
                    "description" => $activity->description,
                    "timestamp" => $activity->created_at->diffForHumans()
                ];
            });

        return Inertia::render('Profile/Index', [
            "userFavorites" => $userFavorites,
            "userActivities" => $userActivities
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('user.profile.index');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

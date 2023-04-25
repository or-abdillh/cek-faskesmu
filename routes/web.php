<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\FacilityController as UserFacilityController;
use App\Http\Controllers\User\FavoriteController as UserFavoriteController;
use App\Http\Controllers\User\ReviewController as UserReviewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Landing Page
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/about', [HomeController::class, 'about'])->name('home.about');
Route::get('/facility', [HomeController::class, 'facility'])->name('home.facility');

// User
Route::group([ 'middleware' => ['auth', 'role:user|provider'] ], function() {

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('user.profile.index');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('user.profile.update');

    // Facility
    Route::get('/facility/{slug}', [UserFacilityController::class, 'detail'])->name('user.facility.detail');
    Route::patch('/facility/{id}', [UserFacilityController::class, 'update'])->name('user.facility.update');

    // Favorite and Review
    Route::group(["as" => "user."], function() {

        Route::resource('/favorite', UserFavoriteController::class);
        Route::resource('/review', UserReviewController::class);
    });
});


require __DIR__.'/auth.php';

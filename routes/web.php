<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\FacilityController as UserFacilityController;
use App\Http\Controllers\User\FavoriteController as UserFavoriteController;
use App\Http\Controllers\User\ReviewController as UserReviewController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
Route::group([ 'middleware' => ['auth', 'role:user'] ], function() {

    // Facility
    Route::get('/facility/{slug}', [UserFacilityController::class, 'detail'])->name('user.facility.detail');

    // Favorite
    Route::group(["as" => "user."], function() {

        Route::resource('/favorite', UserFavoriteController::class);
        Route::resource('/review', UserReviewController::class);
    });
});


require __DIR__.'/auth.php';

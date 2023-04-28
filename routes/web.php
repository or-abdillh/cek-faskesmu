<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\FacilityController as UserFacilityController;
use App\Http\Controllers\User\FavoriteController as UserFavoriteController;
use App\Http\Controllers\User\ReviewController as UserReviewController;
use App\Http\Controllers\User\ServiceController as UserServiceController;
use App\Http\Controllers\User\DrugController as UserDrugController;
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
    Route::post('/facility', [UserFacilityController::class, 'store'])->name('user.facility.store');

    // Service
    Route::post('/service', [UserServiceController::class, 'store'])->name('user.service.store');
    Route::patch('/service/{id}', [UserServiceController::class, 'update'])->name('user.service.update');
    Route::delete('/service/{id}', [UserServiceController::class, 'destroy'])->name('user.service.destroy');
    
    // Drug
    Route::post('/drug', [UserDrugController::class, 'store'])->name('user.drug.store');
    Route::patch('/drug/{id}', [UserDrugController::class, 'update'])->name('user.drug.update');
    Route::delete('/drug/{id}', [UserDrugController::class, 'destroy'])->name('user.drug.destroy');
    
    // Reset
    Route::delete('/reset/facility', [UserFacilityController::class, 'reset'])->name('user.reset.facility');
    Route::delete('/reset/drug', [UserDrugController::class, 'reset'])->name('user.reset.drug');
    Route::delete('/reset/service', [UserServiceController::class, 'reset'])->name('user.reset.service');

    // Price comparison
    Route::get('/facility/{facility_slug}/price-compare/service/{id}', [UserFacilityController::class, 'serviceCompare'])->name('user.facility.price-compare.service');
    Route::get('/facility/{facility_slug}/price-compare/drug/{id}', [UserFacilityController::class, 'drugCompare'])->name('user.facility.price-compare.drug');

    // Favorite and Review
    Route::group(["as" => "user."], function() {

        Route::resource('/favorite', UserFavoriteController::class);
        Route::resource('/review', UserReviewController::class);
    });
});


require __DIR__.'/auth.php';

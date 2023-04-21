<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\FacilityController as UserFacilityController;
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

    Route::get('/facility/{slug}', [UserFacilityController::class, 'detail'])->name('user.facility.detail');
});


require __DIR__.'/auth.php';

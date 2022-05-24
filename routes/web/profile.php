<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::name('profile.')->prefix('/profile')->controller(ProfileController::class)->group(function () {
    Route::get('/{slug}', 'show');
});
<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;

Route::middleware('auth:web')->name('add-a-review.')->prefix('/add-a-review')->group(function() {
    Route::post('/', [App\Http\Controllers\ReviewController::class, 'store'])->name('store');
    Route::get('/{id}', [App\Http\Controllers\ReviewController::class, 'writeReview']);

});
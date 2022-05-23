<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::controller(PostController::class)->group(function() {
    Route::get('company/', 'index')->name('posts');
    Route::get('company/{slug}', 'show')->name('posts.show');
});

Route::middleware('auth:web')->name('write-a-review.')->prefix('/write-a-review')->group(function() {

    Route::get('/', [App\Http\Controllers\PostController::class, 'writePost'])->name('index');
    Route::get('/{id}', [App\Http\Controllers\PostController::class, 'editPost'])->name('edit');
    Route::patch('/{id}', [App\Http\Controllers\PostController::class, 'storePost'])->name('update');
    Route::post('/save-post', [App\Http\Controllers\PostController::class, 'storePost'])->name('store');
});
 

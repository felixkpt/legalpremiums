<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;

Route::controller(AuthorController::class)->group(function() {

    Route::get('/authors', 'index');
    Route::get('/authors/{author}', 'show');
    Route::get('/authors/{author}/lead', 'lead');

});
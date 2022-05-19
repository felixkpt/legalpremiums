<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;

Route::prefix('/categories')->name('categories.')->controller(CategoryController::class)->group(function() {

    Route::get('/', 'index')->name('index');
    Route::get('/{category}', 'show')->name('show');

});
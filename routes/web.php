<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
Route::get('/', function () {
    
    // Check if any user is registered
    if (!User::take(1)->first()) {
        return redirect()->route('register');
    }else {
        return (new HomeController)->index();
    }

})->name('home');

Route::get('/search', [SearchController::class, 'index'])->name('search');

require __DIR__.'/auth.php';

require  __DIR__.'/web/index.php';



//Fallback/Catchall Route
Route::fallback(function (Request $request) {
    $title = 'Oops! Nothing was found';
    $view = $request->is('admin/*') ? 'admin.errors.404' : 'errors.404';
    return view($view, compact('title'));
});

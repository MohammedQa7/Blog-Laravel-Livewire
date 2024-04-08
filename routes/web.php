<?php

use App\Http\Controllers\HomePageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get( '/', 'App\Http\Controllers\HomePageController');
Route::get( '/blogs', 'App\Http\Controllers\PostController@index');
Route::get( 'blogs/p/{post_slug}', 'App\Http\Controllers\PostController@show');

Route::get( '/language/{locale}', function($locale){
    if ($locale === 'ar' || $locale === 'en') {
        session()->put('locale' , $locale);
    }
    return redirect()->back();
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
});

<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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
});

Route::get('/auth/redirect', [\App\Http\Controllers\Auth\GoogleController::class,'redirect'])->name('google_redirect');

Route::get('/auth/callback', [\App\Http\Controllers\Auth\GoogleController::class,'callback'])->name('google_callback');

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

Route::get('/', [\App\Http\Controllers\MainController::class,'index'])->name('home');
Route::get('/email/{code}', [\App\Http\Controllers\MainController::class,'updateEmail'])->name('email');
Route::get('/email/{code}', [\App\Http\Controllers\MainController::class,'confirmEmail'])->name('confirm');

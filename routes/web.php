<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [\App\Http\Controllers\MainController::class, 'index'])->name('home');
Route::get('/email/{code}', [\App\Http\Controllers\MainController::class, 'updateEmail'])->name('email');
Route::get('/confirm/{slug}', [\App\Http\Controllers\MainController::class, 'confirmEmail'])->name('confirm');

Route::get('admin/login', [\App\Http\Controllers\Admin\MainController::class, 'login'])->name('admin.login');
Route::post('admin/loginAction', [\App\Http\Controllers\Admin\MainController::class, 'loginAction'])->name('admin.loginAction');

Route::middleware(\App\Http\Middleware\AdminRoleChecker::class)->group(function () {
    Route::get('admin', [\App\Http\Controllers\Admin\MainController::class, 'dashboard'])->name('admin.dashboard');

    Route::resource('admin/events', \App\Http\Controllers\Admin\EventController::class)->names('admin.events');
    Route::resource('admin/users', \App\Http\Controllers\Admin\UserController::class)->names('admin.users');
    Route::resource('admin/categories', \App\Http\Controllers\Admin\CategoryController::class)->names('admin.categories');

    Route::get('admin/logout',[\App\Http\Controllers\Admin\MainController::class,'logout'])->name('admin.logout');
    Route::get('t',function (){

    });
});

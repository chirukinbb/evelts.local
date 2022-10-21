<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('v1/auth', [\App\Http\Controllers\Api\UserController::class, 'auth']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('v1/user/updateData', [\App\Http\Controllers\Api\UserController::class, 'update']);
    Route::post('v1/user/updatePassword', [\App\Http\Controllers\Api\UserController::class, 'updatePassword']);
    Route::post('v1/user/updateEmail', [\App\Http\Controllers\Api\UserController::class, 'updateEmail']);

    Route::get('v1/categories', [\App\Http\Controllers\Api\CategoryController::class, 'index']);

    Route::get('v1/events', [\App\Http\Controllers\Api\EventController::class, 'index']);
    Route::get('v1/event/create', [\App\Http\Controllers\Api\EventController::class, 'create']);
    Route::get('v1/event/update', [\App\Http\Controllers\Api\EventController::class, 'update']);
    Route::get('v1/event/{id}', [\App\Http\Controllers\Api\EventController::class, 'get']);
});

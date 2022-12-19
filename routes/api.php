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

Route::get('v1/categories', [\App\Http\Controllers\Api\EntityController::class, 'categories']);
Route::get('v1/dates', [\App\Http\Controllers\Api\EventController::class, 'dates']);
Route::get('v1/countries', [\App\Http\Controllers\Api\EntityController::class, 'countries']);
Route::get('v1/points', [\App\Http\Controllers\Api\EntityController::class, 'points']);
Route::get('v1/tags', [\App\Http\Controllers\Api\EntityController::class, 'tags']);
Route::get('v1/events', [\App\Http\Controllers\Api\EventController::class, 'index']);
Route::get('v1/event/{id}', [\App\Http\Controllers\Api\EventController::class, 'get']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('v1/user/updateData', [\App\Http\Controllers\Api\UserController::class, 'update']);
    Route::post('v1/user/updatePassword', [\App\Http\Controllers\Api\UserController::class, 'updatePassword']);
    Route::post('v1/user/updateEmail', [\App\Http\Controllers\Api\UserController::class, 'updateEmail']);
    Route::post('v1/user/following/{id}', [\App\Http\Controllers\Api\UserController::class, 'following']);
    Route::post('v1/user/unfollowing/{id}', [\App\Http\Controllers\Api\UserController::class, 'unfollowing']);
    Route::post('v1/user/acceptFriendship/{id}', [\App\Http\Controllers\Api\UserController::class, 'acceptFriendship']);
    Route::post('v1/user/removeFromFriend/{id}', [\App\Http\Controllers\Api\UserController::class, 'removeFromFriend']);

    Route::post('v1/event/create', [\App\Http\Controllers\Api\EventController::class, 'create']);
    Route::post('v1/event/update', [\App\Http\Controllers\Api\EventController::class, 'update']);
    Route::get('v1/event/subscribe/{id}', [\App\Http\Controllers\Api\EventController::class, 'subscribe']);
    Route::get('v1/event/unsubscribe/{id}', [\App\Http\Controllers\Api\EventController::class, 'unsubscribe']);
    Route::post('v1/event/addComment', [\App\Http\Controllers\Api\EventController::class, 'addComment']);
    Route::post('v1/event/editComment/{id}', [\App\Http\Controllers\Api\EventController::class, 'editComment']);
    Route::get('v1/event/deleteComment/{id}', [\App\Http\Controllers\Api\EventController::class, 'deleteComment']);
    Route::post('v1/event/{id}/addPhoto', [\App\Http\Controllers\Api\EventSubEntitiesController::class, 'addPhoto']);
    Route::get('v1/event/removePhoto/{id}',
        [\App\Http\Controllers\Api\EventSubEntitiesController::class, 'removePhoto']);
});

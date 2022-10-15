<?php

use Illuminate\Http\Request;
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

Route::post('v1/auth',[\App\Http\Controllers\Api\UserController::class,'auth']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('v1/user/updateData',[\App\Http\Controllers\Api\UserController::class,'update']);
    Route::post('v1/user/updatePassword',[\App\Http\Controllers\Api\UserController::class,'updatePassword']);
    Route::post('v1/user/updateEmail',[\App\Http\Controllers\Api\UserController::class,'updateEmail']);
});

<?php

namespace App\Http\Controllers\Api;

use App\Facades\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\UserDataRequest;
use App\Http\Requests\UserEmailRequest;
use App\Http\Requests\UserPasswordRequest;
use App\Http\Resources\AuthResource;

class UserController extends Controller
{
    public function auth(AuthRequest $request)
    {
        return ($user = User::auth($request->all())) ?
            AuthResource::make($user) : response()->json(0,403);
    }

    public function update(UserDataRequest $request)
    {
        return response()->json(User::updateData($request->full()));
    }

    public function updatePassword(UserPasswordRequest $request)
    {
        return response()->json(User::changePassword($request->all()));
    }
}

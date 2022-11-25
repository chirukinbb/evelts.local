<?php

namespace App\Http\Controllers\Api;

use App\Facades\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\UserDataRequest;
use App\Http\Requests\UserPasswordRequest;
use App\Http\Resources\AuthResource;

class UserController extends Controller
{
    public function auth(AuthRequest $request)
    {
        $user = $request->input('password') ? User::auth($request->input('password'), $request->input('email'))
            : User::oAuth($request->input('type'), $request->input('token'));

        return $user ? AuthResource::make($user) :
            response()->json(0, 403);
    }

    public function update(UserDataRequest $request)
    {
        return response()->json(User::updateData($request->full()));
    }

    public function updatePassword(UserPasswordRequest $request)
    {
        return response()->json(User::changePassword($request->all()));
    }

    public function following(int $userId)
    {
        User::following($userId);

        return response()->json();
    }

    public function unfollowing(int $userId)
    {
        User::unfollowing($userId);

        return response()->json();
    }

    public function acceptFriendship(int $userId)
    {
        User::acceptFriendship($userId);

        return response()->json();
    }

    public function removeFromFriend(int $userId)
    {
        User::removeFromFriend($userId);

        return response()->json();
    }
}

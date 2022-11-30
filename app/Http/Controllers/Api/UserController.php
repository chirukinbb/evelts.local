<?php

namespace App\Http\Controllers\Api;

use App\Events\UserRegisterEvent;
use App\Facades\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\UserDataRequest;
use App\Http\Requests\UserPasswordRequest;
use App\Http\Resources\AuthResource;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function auth(AuthRequest $request)
    {
        $user = \App\Models\User::whereEmail($request->input('email'))->first();

        if (is_null($user)) {
            list($user, $password, $slug) = $this->registration($request->input('email'), $request->input('password'));

            UserRegisterEvent::dispatch($user, $password, $slug);
        }

        return $request->input('password') ?
            (Hash::check($request->input('password'), $user->password) ? AuthResource::make(User::login($request->input('email'))) : response()->json(0, 403)) :
            AuthResource::make(User::login($request->input('email')));
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

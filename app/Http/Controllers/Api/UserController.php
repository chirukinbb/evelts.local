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
        $user = \App\Models\User::whereEmail($request->email)->first();

        if (is_null($user)) {
            extract($this->registration($request->email, $request->password));

            UserRegisterEvent::dispatch($user, $password, $slug);
        }

        return $request->password ?
            (Hash::check($request->password, $user->password) ?
                AuthResource::make(User::login($request->email)) :
                response()->json(0, 403)) :
            AuthResource::make(User::login($request->email));
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

    private function registration(string $email, string $password)
    {
        return User::registration($email, $password);
    }
}

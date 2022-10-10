<?php

namespace App\Services;

use App\Jobs\SendRegistratiobMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Laravel\Socialite\Facades\Socialite;

class UserService
{
    public function auth(array $attrs)
    {
        if (User::whereEmail($attrs['email'])->exists()) {
            $this->registration($attrs);
        }

        return $this->login($attrs);
    }

    protected function registration(array $attrs)
    {
        $user = User::getModel();

        $user->password = $attrs['password'];
        $user->email = $attrs['email'];
        $user->name = $attrs['name'];

        $user->save();

        $slug = \Str::random(6);
        \DB::table('confirms')->insert([
            'user_id'=>$user->id,
            'slug'=>\Hash::make($slug)
        ]);

        SendRegistratiobMail::dispatch($user,$attrs['password'],$slug);

        return $user;
    }

    protected function addData(User $user, int $type, string $token)
    {
        switch ($type) {
            case User::FACEBOOK_AUTH:
                $socialite_user = Socialite::driver('facebook')->userFromToken($token);
                $user->facebook_token = $token;
                break;
            case User::GOOGLE_AUTH:
                $socialite_user = Socialite::driver('google')->userFromToken($token);
                $user->google_token = $token;
                break;
            default:
        }

        $user->name = $socialite_user->getName();
        $user->avatar_url = $socialite_user->getAvatar();
        $user->save();
    }

    protected function login(array $attrs)
    {
        $user = User::whereEmail($attrs['email'])->first();

        switch ($attrs['type']) {
            case User::FACEBOOK_AUTH:
                if (is_null($user->facebook_token))
                    $this->addData($user,User::FACEBOOK_AUTH,$attrs['password']);

                $isLogin = \Hash::check($attrs['password'],$user->facebook_token);
                break;
            case User::GOOGLE_AUTH:
                if (is_null($user->google_token))
                    $this->addData($user,User::GOOGLE_AUTH,$attrs['password']);

                $isLogin = \Hash::check($attrs['password'],$user->google_token);
                break;
            default:
                $isLogin = Auth::attempt($attrs,$attrs['remember_me'] ?? false);
                $user  = Auth::user();
        }

        return $isLogin ? $user : false;
    }

    public function confirm(array $attrs)
    {
        $user = User::whereEmail($attrs['email'])->first();
        $slug = \DB::table('confirms')->select('slug')
            ->where('id',$user->id)->first()->slug;

        if (\Hash::check($attrs['slug'],$slug)){
            $user->email_verified_at = Carbon::now();
            $user->save();
        }
    }

    public function updateData(array $attrs)
    {
        /**
         * @var UploadedFile $avatar
         */
        $avatar = $attrs['avatar'];
        Auth::user()->update([
            'avatar_url'=>$avatar->storePublicly('avatars'),
            'name'=>$attrs['name'],
            'description'=>$attrs['description']
        ]);
    }
}

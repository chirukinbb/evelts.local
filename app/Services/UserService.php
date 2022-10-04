<?php

namespace App\Services;

use App\Http\Resources\AuthResource;
use App\Jobs\SendRegistratiobMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function auth(array $attrs)
    {
        if (User::whereEmail($attrs['email'])->exists()) {
            $this->registration($attrs);
        }

        return ($this->login($attrs)) ?
            AuthResource::make($this->login($attrs))
            : response()->json(0);
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
    }

    protected function login(array $attrs)
    {
        $user = User::whereEmail($attrs['email'])->first();

        switch ($attrs['type']) {
            case User::FACEBOOK_AUTH:
                $isLogin = \Hash::check($attrs['token'],$user->facebook_token);
                break;
            case User::GOOGLE_AUTH:
                $isLogin = \Hash::check($attrs['token'],$user->google_token);
                break;
            default:
                $isLogin = Auth::attempt($attrs,$attrs['remember_me']);
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
}

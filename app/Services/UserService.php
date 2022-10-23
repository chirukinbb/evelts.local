<?php

namespace App\Services;

use App\Jobs\SendRegistratiobMail;
use App\Mail\ChangeEmailMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            'user_id' => $user->id,
            'slug' => \Hash::make($slug)
        ]);

        SendRegistratiobMail::dispatch($user, $attrs['password'], $slug);

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
                    $this->addData($user, User::FACEBOOK_AUTH, $attrs['password']);

                $isLogin = \Hash::check($attrs['password'], $user->facebook_token);
                break;
            case User::GOOGLE_AUTH:
                if (is_null($user->google_token))
                    $this->addData($user, User::GOOGLE_AUTH, $attrs['password']);

                $isLogin = \Hash::check($attrs['password'], $user->google_token);
                break;
            default:
                $isLogin = Auth::attempt($attrs, $attrs['remember_me'] ?? false);
                $user = Auth::user();
        }

        return $isLogin ? $user : false;
    }

    public function confirm(string $email, string $slug)
    {
        $user = User::whereEmail($email)->first();
        $slugHash = \DB::table('confirms')->select('slug')
            ->where('id', $user->id)->first()->slug;

        if (\Hash::check($slug, $slugHash)) {
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
        return Auth::user()->update([
            'avatar_url' => $avatar->storePublicly('avatars'),
            'name' => $attrs['name'],
            'description' => $attrs['description']
        ]);
    }

    public function changePassword(array $attrs)
    {
        if (Hash::check($attrs['password'], Auth::user()->password)) {
            Auth::user()->password = $attrs['new_password'];

            return Auth::user()->save();
        }

        return false;
    }

    public function changeEmailRequest(array $attrs)
    {
        if (Hash::check($attrs['password'], Auth::user()->password)) {
            $code = \Str::random();

            $result = \DB::table('changes')->update([
                'user_id' => Auth::id(),
                'code' => $code,
                'new_email' => $attrs['email']
            ]);

            \Mail::to($attrs['email'])->send(new ChangeEmailMail(Auth::user(), $code));

            return $result;
        }

        return false;
    }

    public function changeEmail(string $code)
    {
        $change = \DB::table('changes')->where('user_id', Auth::id())
            ->first();

        if ($change && Hash::check($code, $change->code)) {
            Auth::user()->email = $change->new_email;

            return Auth::user()->save();
        }

        return false;
    }

    public function following(int $userId)
    {
        User::whereId($userId)->followers()->add(['first_user_id' => Auth::id()]);
    }

    public function acceptFriendship(int $userId)
    {
        User::whereId($userId)->followers()->where('first_user_id', Auth::id());
    }

    public function removeFromFriend(int $userId)
    {
        User::whereId($userId)->followers()->where('first_user_id', Auth::id());
    }

    public function unfollowing(int $userId)
    {
        User::whereId($userId)->followers()->where('first_user_id', Auth::id());
    }
}

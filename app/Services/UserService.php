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
    public function auth(string $password, string $email)
    {
        $user = User::whereEmail($email)->first();

        if (is_null($user)) {
            $this->registration($email, $password);
        }

        return Hash::check($password, $user->password) ? $this->login($email) : false;
    }

    public function oAuth(int $type, string $token)
    {
        switch ($type) {
            case User::FACEBOOK_AUTH:
                $socialite_user = Socialite::driver('facebook')->userFromToken($token);
                break;
            case User::GOOGLE_AUTH:
                $socialite_user = Socialite::driver('google')->userFromToken($token);
                break;
            default:
        }

        /**
         * @var \Laravel\Socialite\Two\User $socialite_user
         */
        if (!User::whereEmail($socialite_user->email)->exists()) {
            $this->registration($socialite_user->email);
        }

        return $this->login($socialite_user->email);
    }

    public function registration(string $email, string $password = '')
    {
        $user = User::getModel();

        $password = empty($password) ? \Str::random(6) : $password;
        $user->password = $password;
        $user->email = $email;

        $user->save();
        $user->assignRole('User');

        $slug = \Str::random(6);
        \DB::table('confirms')->insert([
            'user_id' => $user->id,
            'slug' => \Hash::make($slug)
        ]);

        SendRegistratiobMail::dispatch($user, $password, $slug);

        return $user;
    }

    protected function login(string $email)
    {
        $user = User::whereEmail($email)->first();

        return Auth::loginUsingId($user->id) ?? false;
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

        return Auth::user()->data->update([
            'avatar_url' => $avatar->storePublicly('avatars'),
            'description' => $attrs['description']
        ]);
    }

    public function updateName(string $name)
    {
        Auth::user()->update(['name' => $name]);
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
